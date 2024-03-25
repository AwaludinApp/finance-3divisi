<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuBesar extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal_transaksi' => 'datetime'
    ];

    protected $dates = ['tanggal_transaksi'];

    protected $fillable = ['akun_id', 'nilai', 'tipe', 'tanggal_transaksi', 'pemasukan', 
        'pengeluaran', 'user_id', 'edited_id', 'deleted_at', 'deleted_by', 'edited_by', 
        'keterangan'];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
