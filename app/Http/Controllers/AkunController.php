<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAkunRequest;
use App\Http\Requests\UpdateAkunRequest;
use App\Models\Akun;
use App\Models\Kategori;
use App\Models\SubAkun;
use App\Models\SubSubAkun;
use Illuminate\Support\Facades\DB;

class AkunController extends Controller
{
    public function akunList(Kategori $kategori)
    {
        $level = 1;

        $akuns = Akun::where('is_deleted', 0)
            ->where('parent_id', $kategori->id)
            ->where('level', $level)
            ->orderBy('id', 'ASC')
            ->paginate(10);

        $title = $kategori->nama_kategori;
        $parent_id = $kategori->id;
        $kategori_id = $parent_id;
        $breadcumb = [
            ['url' => route('kategori.index'), 'label' => 'Kategori']
        ];

        $next_level = 2;
        

        return view('pages.akun.index', compact('title', 'akuns', 'kategori_id', 'breadcumb', 
            'parent_id', 'next_level', 'level'));    
    }

    public function akun(Akun $akun, $level)
    {
        $akuns = Akun::where('is_deleted', 0)
            ->where('parent_id', $akun->id)
            ->where('level', $level)
            ->orderBy('id', 'ASC')
            ->paginate(10);

        $title = $akun->kode_akun . ' - ' . $akun->nama_akun;
        $parent_id = $akun->id;
        $kategori_id = $parent_id;
        $breadcumb_cat = [
            ['url' => route('kategori.index'), 'label' => 'Kategori']
        ];

        $breadcumb = [];
        $breadcumb_in = [];
        for($i=1;$i<$level;$i++) {
            if ($akun->parent != null && $akun->level != 1) {
                $breadcumb_in[] = ['url' => route('sub.akun', ['akun' => $akun->parent->id, 'level' => $akun->level ]),
                'label' => $akun->parent->nama_akun ];
                $akun = $akun->parent;                
            }
        }

        foreach($breadcumb_in as $b) {
            $breadcumb[] = array_pop($breadcumb_in);
        }

        $kategori_id = $akun->parent_id;

        $kategori = Kategori::find($kategori_id);
        $breadcumb_first[] = ['url' => route('kategori.akun', ['kategori' => $kategori->id ]),
            'label' => $kategori->nama_kategori ];

        $breadcumb = array_merge($breadcumb_cat, $breadcumb_first, $breadcumb);    

        $next_level = $level + 1;

        return view('pages.akun.index', compact('title', 'akuns', 'kategori_id', 'breadcumb', 
            'parent_id', 'next_level', 'level'));
    }

    /**
     * Display a listing of the resource.
     */
    public function _akun($parent_id)
    {
        //
        $akuns = Akun::where('is_deleted', 0)
            ->where('sub_sub_akun_id', $parent_id)
            ->orderBy('id', 'ASC')
            ->paginate(10);

        
        $subsubakun = SubSubAkun::find($parent_id);
        $sub_akun_id = $subsubakun->sub_akun_id;

        $subakun = SubAkun::find($sub_akun_id);
        $nama_sub_akun = $subsubakun->nama_akun;
        $kategori_id = $subakun->kategori_id;
        $kode_akun = $subsubakun->kode_akun;
        $nama_akun = $subsubakun->nama_akun;
        $nama_kategori = $subakun->kategori->nama_kategori;
        $sub_sub_akun_id = $subsubakun->id;
        $nama_sub_akun = $subakun->nama_akun;

        $title = $kode_akun . ' - ' . $nama_akun;

        return view('pages.akun.index', compact('title', 'akuns', 'parent_id', 'nama_sub_akun',
            'kategori_id', 'nama_akun', 'nama_kategori', 'sub_akun_id', 'sub_sub_akun_id'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAkunRequest $request)
    {
        //
                //
        $res = Akun::create([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $request->nama_akun,
            'parent_id' => $request->parent_id,
            'level' => $request->level,
            'is_deleted' => 0,
        ]);

        if ($request->level == 1 ) {
            $url = route('kategori.akun', ['kategori' => $request->parent_id]);
        } else {
            $url  = route('sub.akun', ['akun' => $request->parent_id, 'level' => $request->level]);
        }

        return response()->json(['success' => true, 
            'message' => 'Akun berhasil disimpan.',
            'redirect' => $url
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAkunRequest $request, Akun $akun)
    {
        //
        $akun->kode_akun = $request->kode_akun;
        $akun->nama_akun = $request->nama_akun;
        $akun->save();

        if ($request->level == 1 ) {
            $url = route('kategori.akun', ['kategori' => $request->parent_id]);
        } else {
            $url  = route('sub.akun', ['akun' => $request->parent_id, 'level' => $request->level]);
        }

        return response()->json(['success' => true, 
            'message' => 'Akun berhasil diubah.',
            'redirect' => $url
        ]);

    }

    public function existance(Akun $akun) 
    {
        $existance_in_bukubesar = $akun->kas_besar()->exists();
        $existance_in_bukukecil = $akun->kas_kecil()->exists();

        if ($existance_in_bukubesar || $existance_in_bukukecil) {
            return response()->json([
                'exists' => true,
                'message' => 'Akun <strong>' . $akun->kode_akun . '</strong> telah digunakan di transaksi, ' .
                    '<br>Transaksi yang menggunakan akun ini akan disembunyikan, dan dapat dikembalikan ' .
                    '<br>Membuat kembali akun dengan kode yang sama'
            ]);
        } else {
            return response()->json([
                'exists' => false,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        //
        DB::beginTransaction();
        try {
            // check jika akun telah digunakan
            // $existance_in_bukubesar = $akun->kas_besar()->get();
            // $existance_in_bukukecil = $akun->kas_kecil()->get();

            // foreach($existance_in_bukubesar as $transaksi) {
            //     $transaksi->is_deleted = 1;
            //     $transaksi->save();
            // }

            // foreach($existance_in_bukukecil as $transaksi) {
            //     $transaksi->is_deleted = 1;
            //     $transaksi->save();
            // }

            $akun_id = $akun->id;

            $akun_children_ids = [];

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

            
            $akun->update(['is_deleted' => 1]);

            Akun::where('is_deleted', 0)->whereIn('id', $akun_children_ids)->update([
                'is_deleted' => 1
            ]);
            DB::commit();
            return response()->json(['success' => true, 
                'message' => 'Akun berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 
                'message' => 'Akun gagal dihapus.',
                'e' => $e->getMessage()
            ]);
        }
    }
}
