<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Kategori::updateOrCreate([
            'nama_kategori' => "Aset",
        ]);
        
        Kategori::updateOrCreate([
            'nama_kategori' => "Liabilitas",
        ]);

        Kategori::updateOrCreate([
            'nama_kategori' => "Aset Neto",
        ]);

        Kategori::updateOrCreate([
            'nama_kategori' => "Pendapatan",
        ]);

        Kategori::updateOrCreate([
            'nama_kategori' => "Biaya-biaya",
        ]);
    }
}
