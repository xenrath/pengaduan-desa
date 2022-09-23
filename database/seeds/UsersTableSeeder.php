<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles') ->insert([
            'role_name' => 'Admin'
        ]);

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678),
            'role_id' => 1,
            'in_active' => true,
            'NIK' => '1234567890123456'
        ]);

        // $user->createToken('BanjarAnyar')->accessToken;
    }
}
