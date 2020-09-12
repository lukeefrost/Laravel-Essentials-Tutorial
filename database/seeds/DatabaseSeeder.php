<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the database?')) {
          $this->command->call('migrate:refresh');
          $this->command->info('Database was refreshed');
        }
        // Run composer dump-autoload everytime a seeder is created
        // Can also call commands like this: php artisan db:seed --class=BlogPostsTableSeeder
        $this->call([UsersTableSeeder::class, BlogPostsTableSeeder::class, CommentsTableSeeder::class]);


        /*$users = $else->concat([$use]); // Concatenate into a single collection

        // Simple way of seeding data
        $posts = factory(App\BlogPost::class, 50)->make()->each(function($post) use ($users) {
          $post->save();
        });

        $comments = factory(App\Comment::class, 150)->create();
        //dd($users->count()); // Returns number of elements
        //dd(get_class($use), get_class($else));*/


    }
}
