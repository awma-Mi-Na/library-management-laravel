<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $admin = User::factory()->create(['username' => 'awma123', 'email' => 'awma@gmail.com']);
        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $author = Author::create(['user_id' => $user->id, 'name' => $user->name]);
            Book::factory()->create(['author_id' => $author->id]);
        }
    }
}
