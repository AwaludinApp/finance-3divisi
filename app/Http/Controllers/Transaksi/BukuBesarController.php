<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaksiBukuBesarRequest;
use App\Http\Requests\StoreTransaksiRequest;
use App\Models\Akun;
use App\Models\BukuBesar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BukuBesarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!in_array(Auth::user()->role, [1,2])) {
            return redirect('dashboard');
        }

        //
        // $buku_besar = BukuBesar::where('is_deleted', 0)
        //     ->orderBy('tanggal_transaksi', 'ASC')
        //     ->where(function($q) {
        //         if (! in_array(Auth::id(), [1])) {
        //             $q->where('user_id', Auth::id());
        //         } 
        //     })
        //     ->get();

        $akuns = Akun::where('is_deleted', 0)
            ->orderBy('id', 'ASC')
            ->orderBy('level')
            ->get();
        
        $title = "Service";

        // return view('pages.transaksi.buku_besar.index', compact('buku_besar', 'akuns', 'title'));
        return view('pages.transaksi.buku_besar.index', compact('akuns', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function parseDate($date)
    {
        $date = explode('/', $date);
        return $date[2] . '-' . $date[1] . '-' . $date[0];
    }

    private function parseNilai($nilai)
    {
        $nilai = str_replace(['Rp. ', '.'], ['', ''], $nilai);
        return $nilai;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiBukuBesarRequest $request)
    {
        //
        try {
            $data = $request->validated();
            $tipe = $data['tipe'];
            $data['nilai'] = $this->parseNilai($data['nilai']);
            $data['pemasukan'] = $tipe == 'Pemasukan' ? $data['nilai'] : null;
            $data['pengeluaran'] = $tipe == 'Pengeluaran' ?  $data['nilai'] : null;
            $data['user_id'] = Auth::id();

            $data['tanggal_transaksi'] = date('Y-m-d H:i:s', strtotime($this->parseDate($data['tanggal_transaksi'])));
            BukuBesar::create($data);

            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Data transaksi berhasil dimasukkan',
                'redirect' => route("buku_besar.index")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data transaksi gagal dimasukkan',
                'e' => $e->getMessage(),
                'redirect' => route("buku_besar.index")
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BukuBesar $buku_besar)
    {
        //
        return response()->json([
            'result' => $buku_besar,
            'tanggal_transaksi' => date('d/m/Y', strtotime($buku_besar->tanggal_transaksi)),
            'nilai' => 'Rp. ' . number_format($buku_besar->nilai, 0, ',', '.')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BukuBesar $bukuBesar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTransaksiBukuBesarRequest $request, BukuBesar $buku_besar)
    {
        //
        try {
            $data = $request->validated();
            $tipe = $data['tipe'];
            $data['nilai'] = $this->parseNilai($data['nilai']);
            $data['pemasukan'] = $tipe == 'Pemasukan' ? $data['nilai'] : null;
            $data['pengeluaran'] = $tipe == 'Pengeluaran' ?  $data['nilai'] : null;
            $data['tanggal_transaksi'] = date('Y-m-d H:i:s', strtotime($this->parseDate($data['tanggal_transaksi'])));
            $data['user_id'] = Auth::id();

            $buku_besar->update($data);

            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Data transaksi berhasil diubah',
                'redirect' => route("buku_besar.index")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data transaksi gagal diubah',
                'e' => $e->getMessage(),
                'redirect' => route("buku_besar.index")
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BukuBesar $buku_besar)
    {
        //
        try {
            $buku_besar->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data transaksi berhasil dihapus',
                'redirect' => route("buku_besar.index")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data transaksi gagal dihapus',
            ]);
        }
    }

    public function data(Request $request)
    {
        // $buku_besar = BukuBesar::where('is_deleted', 0)
        //     ->orderBy('tanggal_transaksi', 'ASC')
        //     ->where(function($q) {
        //         if (! in_array(Auth::id(), [1])) {
        //             $q->where('user_id', Auth::id());
        //         } 
        //     })
        //     ->get();

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        // $totalRecords = Employees::select('count(*) as allcount')->count();
        
        $totalRecords = BukuBesar::select('count(*) as allcount')
            ->where('is_deleted', 0)
            ->orderBy('tanggal_transaksi', 'ASC')
            // ->where(function($q) {
            //     if (! in_array(Auth::id(), [1])) {
            //         $q->where('user_id', Auth::id());
            //     } 
            // })
            ->count();
        // $totalRecordswithFilter = Employees::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();
        $totalRecordswithFilter = BukuBesar::with('akun')
            ->select('count(buku_besars.id) as allcount')
            ->leftJoin('akuns', 'akuns.id', '=', 'akun_id')
            ->where('buku_besars.is_deleted', 0)
            ->orderBy('tanggal_transaksi', 'ASC')
            // ->where(function($q) {
                // if (! in_array(Auth::id(), [1])) {
                //     $q->where('user_id', Auth::id());
                // } 
            // })
            ->where(function($q) use ($searchValue) {
                $q->where('akuns.kode_akun', 'like', '%' . $searchValue . '%');
                $q->orWhere('akuns.kode_akun', 'like', '' . $searchValue . '%');
                $q->orWhere('akuns.nama_akun', 'like', '%' . $searchValue . '%');
                $q->orWhere('akuns.nama_akun', 'like', '%' . $searchValue . '%');
            })
            ->count();

        // Fetch records
        // $records = Employees::orderBy($columnName,$columnSortOrder)
        //        ->where('employees.name', 'like', '%' .$searchValue . '%')
        //       ->select('employees.*')
        //       ->skip($start)
        //       ->take($rowperpage)
        //       ->get();

        $records = BukuBesar::with('akun')
            ->selectRaw('buku_besars.*, kode_akun, nama_akun')
            ->where('buku_besars.is_deleted', 0)
            ->leftJoin('akuns', 'akuns.id', '=', 'akun_id')
            ->orderBy('tanggal_transaksi', 'ASC')
            // ->where(function($q) {
            //     if (! in_array(Auth::id(), [1])) {
            //         $q->where('user_id', Auth::id());
            //     } 
            // })
            ->where(function($q) use ($searchValue) {
                $q->where('akuns.kode_akun', 'like', '%' . $searchValue . '%');
                $q->orWhere('akuns.kode_akun', 'like', '' . $searchValue . '%');
                $q->orWhere('akuns.nama_akun', 'like', '%' . $searchValue . '%');
                $q->orWhere('akuns.nama_akun', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $i = 0;
        foreach($records as $record){
           $id = $record->id;
           $kode_akun = $record->kode_akun;
           $nama_akun = $record->nama_akun;
           $pemasukan = $record->pemasukan;
           $pengeluaran = $record->pengeluaran;
           $keterangan = $record->keterangan;

           $action = '
            <button class="btn btn-sm btn-primary" data-action="edit" 
                data-toggle="modal" data-target="#editTransaksi"
                data-id="' . $id .'"
                data-nama="'. $nama_akun .'"
                data-kode="'. $kode_akun .'">
                <i class="fa fa-edit"></i></button>
            <button class="btn btn-sm btn-danger" 
                data-toggle="modal" data-target="#deleteDialog"
                data-id="'. $id .'"
                data-info="'. $kode_akun .'" 
                data-url="'. route('buku_besar.destroy', ['buku_besar' => $id]) .'">
                <i class="fa fa-trash"></i></button>
           ';

           $data_arr[] = array(
               "id" => ++$i,
               "tanggal_transaksi" => $record->tanggal_transaksi->isoFormat('D MMMM Y'),
               "kode_akun" => $kode_akun,
               "nama_akun" => $nama_akun,
               "pemasukan" => number_format($pemasukan, 0, ',', '.'),
               "pengeluaran" => number_format($pengeluaran, 0, ',', '.'),
               "keterangan" => $keterangan,
               "action" => $action,
           );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response); 
    }
}
