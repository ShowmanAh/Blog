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
     $user = App\User::create([
          'name' => 'Showman Ahmed',
          'email' => 'showman.sh.ahmed@gmail.com',
          'password' => bcrypt('12345678'),
          'admin' => 1,

      ]);
      App\Profile::create([
          'user_id' => $user->id,
          'avatar' => 'uploads\posts\1.jpg',
          'about' => 'lorem ipsom what can yuo do in the public gaming',
          'facebook' => 'facebook.com',
          'youtube' => 'youtube.com',



      ]);
    }

}
