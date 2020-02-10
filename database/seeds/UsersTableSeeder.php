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
      App\User::create([
          'name' => 'Showman Ahmed',
          'email' => 'showman.sh.ahmed@gmail.com',
          'password' => '12345678'

      ]);
    }
}
