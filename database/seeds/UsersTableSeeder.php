<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        \App\Models\Auth\User::truncate();
        DB::statement("SET foreign_key_checks=1");

        $user = \App\Models\Auth\User::create([
            'name' => 'admin',
            'email' => 'admin@test.dev',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
        ]);

        $admin = \App\Models\Auth\Role::where('name', '=', 'admin')->first();

        $user->attachRole($admin);

        factory(\App\Models\Auth\User::class, 10)->create();
    }
}
