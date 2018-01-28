<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namarole');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namauser')->nullable();
            $table->string('alamatuser')->nullable();
            $table->string('noktpuser')->nullable();
            $table->string('nohpuser')->nullable();
            $table->unsignedInteger('tps_id')->nullable();
            $table->string('username');
            $table->unsignedInteger('role_id');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('kabupatens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namakabupaten');
            $table->timestamps();

        });

        Schema::create('kecamatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namakecamatan');
            $table->unsignedInteger('kabupaten_id');
            $table->timestamps();
        });

        Schema::create('desas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namadesas');
            $table->unsignedInteger('kecamatan_id');
            $table->timestamps();
        });

        Schema::create('tps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namatps');
            $table->unsignedInteger('desa_id');
            $table->timestamps();
        });

        Schema::create('peoples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('noktp');
            $table->string('nohp');
            $table->unsignedInteger('tps_id');
            $table->timestamps();
        });

        Schema::table('users',function (Blueprint $table){
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tps_id')->references('id')->on('tps')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('kecamatans',function (Blueprint $table){
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('desas',function (Blueprint $table){
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans ')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('tps',function (Blueprint $table){
            $table->foreign('desa_id')->references('id')->on('desas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('peoples');
        Schema::dropIfExists('kabupatens');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('kecamatans');
        Schema::dropIfExists('desas');
        Schema::dropIfExists('tps');
    }
}
