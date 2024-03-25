<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\BukuKecil;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBukuKecilController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!in_array(Auth::user()->role, [1,3,4])) {
            return redirect("dashboard");
        }

        $akun_children_ids = [];

        $title = 'Laporan Sparepart';

        $akuns = Akun::where('is_deleted', 0)
            ->orderBy('id', 'ASC')
            ->orderBy('level')
            ->get();

        $akun_id = $request->has('akun_id') ? ($request->akun_id == 'Semua' ? '' : $request->akun_id) : '';
        $start = $request->has('dari_tanggal') ? $request->dari_tanggal : date('Y-m-d');
        $end = $request->has('sampai_tanggal') ? $request->sampai_tanggal : date('Y-m-d');

        $akun_children_ids[] = $akun_id;

        if ($akun_id != '') {
            $akun = Akun::where('is_deleted', 0)
                ->where('id', $akun_id)
                ->first();
            // check children_ids
            if($akun != null) {
                $level = $akun->level; 

                $children = $akun->children()
                    ->where('is_deleted', 0)
                    ->where('level', ++$level)
                    ->get();
                
                foreach($children as $child) {
                    $akun_children_ids[] = $child->id;
                    $grand_children = $child->children()
                        ->where('is_deleted', 0)
                        ->where('level', ++$level)
                        ->get();
                    foreach($grand_children as $grandchild) {
                        $akun_children_ids[] = $grandchild->id;
                        $grand_grand_children = $grandchild->children()
                            ->where('is_deleted', 0)
                            ->where('level', ++$level)
                            ->get();
                        foreach($grand_grand_children as $grandgrandchild) {
                            $akun_children_ids[] = $grandgrandchild->id;
                        }
                    }
                }
            }
        }

        $buku_kecil = BukuKecil::where('is_deleted', 0)
            ->where(function($q) use ($akun_id, $start, $end){
                
                // if ($akun_id != '') {
                //     $q->where('akun_id', $akun_id);
                // }
                if ($start == $end && $start != '') {
                    $q->whereRaw("date(tanggal_transaksi) = '". $start . "'");
                } else if ($start != ''){
                    $q->whereRaw("date(tanggal_transaksi) between '" . $start .  "' AND '" . $end . "'"); 
                }

            })
            // ->where(function($q) {
            //     if (! in_array(Auth::id(), [1, 4])) {
            //         $q->where('user_id', Auth::id());
            //     } 
            // })
            ->where(function($q) use ($akun_id, $akun_children_ids) {
                if ($akun_id != '') {
                    $q->whereIn('akun_id', $akun_children_ids);
                }
            })
            ->orderBy('tanggal_transaksi')
            ->get();

        if ($akun_id != '') {
            $data_akun = Akun::find($akun_id);
        }
        
        $info_akun['nama'] = ($akun_id == '') ? '' : $data_akun->nama_akun;
        $info_akun['kode'] = ($akun_id == '') ? '' : $data_akun->kode_akun;

        $queries = http_build_query(request()->query());

        return view('pages.laporan.buku_kecil', compact('title', 'buku_kecil', 
            'queries', 'akuns', 'start', 'end', 'info_akun', 'akun_id'));
    }

    public function export_pdf(Request $request)
    {
        if (!in_array(Auth::user()->role, [1,3,4])) {
            return redirect("dashboard");
        }

        $akun_children_ids = [];

        $title = 'Laporan Kas Besar';

        $akuns = Akun::where('is_deleted', 0)
            ->orderBy('id', 'ASC')
            ->orderBy('level')
            ->get();

        $akun_id = $request->has('akun_id') ? ($request->akun_id == 'Semua' ? '' : $request->akun_id) : '';
        $start = $request->has('dari_tanggal') ? $request->dari_tanggal : date('Y-m-d');
        $end = $request->has('sampai_tanggal') ? $request->sampai_tanggal : date('Y-m-d');

        $akun_children_ids[] = $akun_id;

        if ($akun_id != '') {
            $akun = Akun::where('is_deleted', 0)
                ->where('id', $akun_id)
                ->first();
            
            // check children_ids
            if($akun != null) {
                $level = $akun->level; 

                $children = $akun->children()
                    ->where('is_deleted', 0)
                    ->where('level', ++$level)
                    ->get();
                
                foreach($children as $child) {
                    $akun_children_ids[] = $child->id;
                    $grand_children = $child->children()
                        ->where('is_deleted', 0)
                        ->where('level', ++$level)
                        ->get();
                    foreach($grand_children as $grandchild) {
                        $akun_children_ids[] = $grandchild->id;
                        $grand_grand_children = $grandchild->children()
                            ->where('is_deleted', 0)
                            ->where('level', ++$level)
                            ->get();
                        foreach($grand_grand_children as $grandgrandchild) {
                            $akun_children_ids[] = $grandgrandchild->id;
                        }
                    }
                }
            }
        }

        $buku_kecil = BukuKecil::where('is_deleted', 0)
            ->where(function($q) use ($akun_id, $start, $end){
                
                // if ($akun_id != '') {
                //     $q->where('akun_id', $akun_id);
                // }
                if ($start == $end && $start != '') {
                    $q->whereRaw("date(tanggal_transaksi) = '". $start . "'");
                } else if ($start != ''){
                    $q->whereRaw("date(tanggal_transaksi) between '" . $start .  "' AND '" . $end . "'"); 
                }

            })
            // ->where(function($q) {
            //     if (! in_array(Auth::id(), [1, 4])) {
            //         $q->where('user_id', Auth::id());
            //     } 
            // })
            ->where(function($q) use ($akun_id, $akun_children_ids) {
                if ($akun_id != '') {
                    $q->whereIn('akun_id', $akun_children_ids);
                }
            })
            ->orderBy('tanggal_transaksi')
            ->get();

        if ($akun_id != '') {
            $data_akun = Akun::find($akun_id);
        }
        
        $info_akun['nama'] = ($akun_id == '') ? '' : $data_akun->nama_akun;
        $info_akun['kode'] = ($akun_id == '') ? '' : $data_akun->kode_akun;

        $queries = http_build_query(request()->query());

        $jenis_kas = 'SPAREPART';

        $pdf = Pdf::loadView('pages.laporan.pdf.buku_kecil', compact('title', 'buku_kecil', 'akuns', 
            'start', 'end', 'info_akun', 'queries', 'jenis_kas', 'queries', 'akun_id'));

        return $pdf->download("laporan-keuangan-sparepart-" . date('dmY-Hi') . '.pdf');
    }
}
