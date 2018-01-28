<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert(
            [
                'id' => '1',
                'namarole' => 'timses'
            ]);
        DB::table('roles')->insert(
            [
                'id' => '2',
                'namarole' => 'timdes'
            ]);
        DB::table('roles')->insert(
            [
                'id' => '3',
                'namarole' => 'gubernur'
            ]);
        DB::table('roles')->insert(
            [
                'id' => '4',
                'namarole' => 'superadmin'
            ]);
    }
}
