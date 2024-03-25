<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $fillable = ['kode_akun','nama_akun', 'parent_id', 'level', 'is_deleted'];

    public function parent()
    {
        return $this->belongsTo(Akun::class, 'parent_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'parent_id')->where('is_deleted', 0);
    }

    public function children()
    {
        return $this->hasMany(Akun::class, 'parent_id');
    }

    public function kas_besar()
    {
        return $this->hasMany(BukuBesar::class);
    }

    public function kas_kecil()
    {
        return $this->hasMany(BukuKecil::class);
    }
}
