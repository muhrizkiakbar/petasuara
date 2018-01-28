<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('kecamatans',function (Blueprint $table){
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('desas',function (Blueprint $table){
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans ')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('tps',function (Blueprint $table){
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('users',function (Blueprint $table){
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('peoples',function (Blueprint $table){
            $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
