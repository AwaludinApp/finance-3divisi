<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $kategoris = Kategori::where('is_deleted', 0)
            ->orderBy('id', 'ASC')
            ->paginate($request->has('limit') ? $request->limit : 10);

        $title = 'Kategori';

        return view('pages.kategori.index', compact('title', 'kategoris'));
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
        Kategori::updateOrCreate([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return response()->json(['success' => true, 
            'message' => 'Kategori berhasil disimpan.',
            'redirect' => route('kategori.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json(['success' => false, 
            'message' => 'Kategori berhasil disimpan.',
            'redirect' => route('kategori.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->is_deleted = 1;
            $kategori->save();

            return response()->json(['success' => true, 
                'message' => 'Kategori berhasil dihapus.',
                'redirect' => route('kategori.index')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 
                'message' => 'Kategori gagal dihapus.',
                'redirect' => route('kategori.index')
            ]);
        }
    }
}
