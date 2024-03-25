<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\AkunChild;
use App\Models\SubAkun;
use App\Models\SubSubAkun;
use Illuminate\Http\Request;

class AkunChildController extends Controller
{
    public function akun($parent_id) 
    {
            //
            $akuns = AkunChild::where('is_deleted', 0)
            ->where('akun_id', $parent_id)
            ->orderBy('id', 'ASC')
            ->paginate(10);

        $akun = Akun::find($parent_id);
        $akun_id = $akun->id;
        
        $subsubakun = SubSubAkun::find($parent_id);
        $sub_akun_id = $subsubakun->sub_akun_id;

        $subakun = SubAkun::find($sub_akun_id);
        $nama_sub_akun = $subsubakun->nama_akun;
        $kategori_id = $subakun->kategori_id;
        $kode_akun = $akun->kode_akun;
        $nama_akun = $akun->nama_akun;
        $nama_kategori = $subakun->kategori->nama_kategori;
        $sub_sub_akun_id = $subsubakun->id;
        $nama_sub_akun = $subakun->nama_akun;

        $title = $kode_akun . ' - ' . $nama_akun;

        return view('pages.akunchild.index', compact('title', 'akuns', 'parent_id', 'nama_sub_akun',
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
    public function store(Request $request)
    {
        //
        $res = AkunChild::updateOrCreate([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $request->nama_akun,
            'akun_id' => $request->parent_id,
        ]);

        return response()->json(['success' => true, 
            'message' => 'Akun berhasil disimpan.',
            'redirect' => route('akunchild.subakun.akun', ['akun' => $request->parent_id])
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(AkunChild $akunChild)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunChild $akunChild)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AkunChild $akun_child)
    {
        //
        $akun_child->kode_akun = $request->kode_akun;
        $akun_child->nama_akun = $request->nama_akun;
        $akun_child->save();


        return response()->json(['success' => true, 
            'message' => 'Akun berhasil diubah.',
            'redirect' => route('akunchild.subakun.akun', ['akun' => $akun_child->akun_id])
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunChild $akunChild)
    {
        //
    }
}
