<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListPelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_pelajaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('guru_id');
            $table->string('hari');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('mata_pelajaran_id')->references('id')
                ->on('mata_pelajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('guru_id')->references('id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_pelajaran');
    }
}
