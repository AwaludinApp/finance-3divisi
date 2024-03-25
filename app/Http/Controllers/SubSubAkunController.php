<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubSubAkunRequest;
use App\Http\Requests\UpdateSubSubAkunRequest;
use App\Models\SubAkun;
use App\Models\SubSubAkun;

class SubSubAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function akun($parent_id)
    {
        //
        $akuns = SubSubAkun::where('is_deleted', 0)
            ->where('sub_akun_id', $parent_id)
            ->orderBy('id', 'ASC')
            ->paginate(10);

        
        $subakun = SubAkun::find($parent_id);
        $kategori_id = $subakun->kategori_id;
        $kode_akun = $subakun->kode_akun;
        $nama_akun = $subakun->nama_akun;
        $nama_kategori = $subakun->kategori->nama_kategori;

        $title = $kode_akun . ' - ' . $nama_akun;

        return view('pages.subsubakun.index', compact('title', 'akuns', 'parent_id', 
            'kategori_id', 'nama_akun', 'nama_kategori'));
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
    public function store(StoreSubSubAkunRequest $request)
    {
        //
        $res = SubSubAkun::updateOrCreate([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $request->nama_akun,
            'sub_akun_id' => $request->parent_id,
        ]);

        return response()->json(['success' => true, 
            'message' => 'Akun berhasil disimpan.',
            'redirect' => route('subakun.akun', ['akun' => $request->parent_id])
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(SubSubAkun $subSubAkun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubSubAkun $subSubAkun)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubSubAkunRequest $request, SubSubAkun $sub_sub_akun)
    {
        //
        $sub_sub_akun->kode_akun = $request->kode_akun;
        $sub_sub_akun->nama_akun = $request->nama_akun;
        $sub_sub_akun->save();


        return response()->json(['success' => true, 
            'message' => 'Akun berhasil diubah.',
            'redirect' => route('subakun.akun', ['akun' => $sub_sub_akun->sub_akun_id])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubSubAkun $subSubAkun)
    {
        //
    }
}
