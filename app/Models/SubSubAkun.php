<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubAkun extends Model
{
    use HasFactory;

    protected $fillable = ['kode_akun','nama_akun', 'sub_akun_id'];

    public function subakun()
    {
        return $this->belongsTo(SubAkun::class);
    }
}
