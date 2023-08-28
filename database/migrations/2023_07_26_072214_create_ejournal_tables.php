<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjournalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejournal', function (Blueprint $table) {
            $table->id('ejournal_id');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->string('judul');
            $table->longtext('deskripsi')->nullable();
            $table->string('file')->nullable();
            $table->bigInteger('ukuran')->nullable();
            $table->string('ext')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();
        });
        Schema::table('ejournal', function (Blueprint $table) {
            $table->foreign('users_id')->references('users_id')->on('users')->nullable();                      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejournal');
    }
}
