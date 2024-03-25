<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seconds', function (Blueprint $table) {
            $table->id();
            $table->datetime('tanggal_transaksi');
            $table->integer('akun_id');
            $table->string('tipe'); // Pemasukan & Pengeluaran
            $table->decimal('nilai', 20, 2);
            $table->decimal('pemasukan', 20, 2)->nullable();
            $table->decimal('pengeluaran', 20, 2)->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->integer('deleted_by')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('edited_by')->default(json_encode([])); // ini json data { ["date" : $datetimr, "user_id" : $user_id] }
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seconds');
    }
}
