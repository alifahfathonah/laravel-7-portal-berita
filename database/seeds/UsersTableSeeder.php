<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Diego Ray',
            'username' => 'diegoray',
            'password' => bcrypt('77677aa'),
            'email' => 'diegoray@email.com',
        ]);
    }
}
