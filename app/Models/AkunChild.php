<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunChild extends Model
{
    use HasFactory;

    protected $fillable = ['kode_akun','nama_akun', 'akun_id'];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
