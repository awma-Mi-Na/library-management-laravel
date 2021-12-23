<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
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
        User::factory()->create(['username' => 'awma123', 'email' => 'awma@gmail.com']);
        $users = User::factory(10)->create();
        $categories = Category::factory(5)->create();
        foreach ($users as $user) {
            $author = Author::create(['user_id' => $user->id, 'name' => $user->name]);
            foreach ($categories as $category) {
                $book = Book::factory()->create(['author_id' => $author->id]);
                BookCategory::create([
                    'book_id' => $book->id,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
/*
for ($i=0; $i < 50; $i++) { 
    $book=Book::factory()->create(['author_id'=>1]);
    BookCategory::create(['book_id'=>$book->id,'category_id'=>rand(1,5)]);
}

? currently: 61 queries (58 books)
? 
*/