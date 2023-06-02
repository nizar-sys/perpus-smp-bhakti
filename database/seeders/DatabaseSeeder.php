<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\StockOpname;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            UserSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
        BookCategory::factory(50)->create();
        Book::factory(100)->create();
        Anggota::factory(1)->create();
        // StockOpname::factory(20)->create();
    }
}
