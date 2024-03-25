<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubAkunRequest;
use App\Http\Requests\UpdateSubAkunRequest;
use App\Models\Kategori;
use App\Models\SubAkun;

class SubAkunController extends Controller
{
    public function akun($parent_id)
    {
        $akuns = SubAkun::where('is_deleted', 0)
            ->where('kategori_id', $parent_id)
            ->orderBy('id', 'ASC')
            ->paginate(10);

        $kategori = Kategori::find($parent_id);
        $nama_kategori = $kategori->nama_kategori;
        $title = $nama_kategori;
        
        return view('pages.subakun.index', compact('title', 'akuns', 'parent_id', 'nama_kategori'));
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
    public function store(StoreSubAkunRequest $request)
    {
        //
        $res = SubAkun::updateOrCreate([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $request->nama_akun,
            'kategori_id' => $request->parent_id,
        ]);

        return response()->json(['success' => true, 
            'message' => 'Akun berhasil disimpan.',
            'redirect' => route('kategori.akun', ['kategori' => $request->parent_id])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubAkun $sub_akun)
    {
        //
        return response()->json($sub_akun);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubAkun $subAkun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubAkunRequest $request, SubAkun $sub_akun)
    {
        //
        $sub_akun->kode_akun = $request->kode_akun;
        $sub_akun->nama_akun = $request->nama_akun;
        $sub_akun->save();


        return response()->json(['success' => true, 
            'message' => 'Akun berhasil diubah.',
            'redirect' => route('kategori.akun', ['kategori' => $sub_akun->kategori_id])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubAkun $subAkun)
    {
        //
    }
}
