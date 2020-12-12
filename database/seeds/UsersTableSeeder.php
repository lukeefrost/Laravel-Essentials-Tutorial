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
      $usersCount = (int)$this->command->ask('How many users would you like?', 20);
      factory(App\User::class)->states('luke-frost')->create();
      factory(App\User::class, $usersCount)->create();
    }
}