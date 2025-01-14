<?php

namespace Database\Seeders;

use App\Models\Book;
use Database\Factories\BooksFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // \App\Models\Book::create([
        //     'title' => 'Buku Laravel',
        //     'author' => 'John Doe',
        //     'description' => 'Panduan lengkap Laravel',
        //     'year' => 2023,
        // ]);

        
        Book::factory()->count(50)->create();
    }
}
