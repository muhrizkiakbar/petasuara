<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                'id' => '1',
                'username' => 'Admin',
                'role_id'=>'4',
                'password'=>bcrypt('12345678')
            ]);
    }
}
