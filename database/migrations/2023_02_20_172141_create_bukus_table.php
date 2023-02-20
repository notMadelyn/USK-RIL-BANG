<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('penerbit_id')->constrained('penerbits')->onDelete('cascade');
            $table->char('tahun_terbit', 4);
            $table->string('isbn', 20)->nullable();
            $table->text('photo')->nullable();
            $table->string('pengarang', 125);
            $table->integer('j_buku_baik');
            $table->integer('j_buku_buruk');
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
        Schema::dropIfExists('bukus');
    }
}
