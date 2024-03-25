<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $limit = 20;
        $users = User::where('is_deleted', 0)
            ->paginate($limit);

        $title="Pengguna";

        return view('pages.pengguna.index', compact('users', 'title'));
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
    public function store(StoreUserRequest $request)
    {
        //
        try {
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => $request->role 
            ]);

            return response()->json(['success' => true, 
                'message' => 'Pengguna berhasil disimpan.',
                'redirect' => route('pengguna.index')
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 
                'message' => 'Pengguna gagal disimpan.',
                'e' => $e->getMessage(),
                'redirect' => route('pengguna.index')
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $pengguna)
    {
        try {
            $current_role = $pengguna->role;


            if ($request->password != '') {
                $pengguna->update([
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => Hash::make($request->password), 
                    'role' => ($current_role != 1) ?  $request->role : 1,
                ]);
            } else {
                $pengguna->update([
                    'email' => $request->email,
                    'name' => $request->name,
                    'role' => ($current_role != 1) ?  $request->role : 1,
                ]);
            }

            return response()->json(['success' => true, 
                'message' => 'Pengguna berhasil diubah.',
                'redirect' => route('pengguna.index')
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 
                'message' => 'Pengguna gagal diubah.',
                'e' => $e->getMessage(),
                'redirect' => route('pengguna.index')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        //
        try {
            $pengguna->is_deleted = 1;
            $pengguna->save();

            return response()->json(['success' => true, 'message' => 'Pengguna berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Pengguna gagal dihapus']);
        }
    }
}
