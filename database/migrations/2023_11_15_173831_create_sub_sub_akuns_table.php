<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_sub_akuns', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun')->nullable();
            $table->string('nama_akun')->nullable();
            $table->integer('sub_akun_id')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_sub_akuns');
    }
};
