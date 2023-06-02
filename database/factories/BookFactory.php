<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_buku' => 'BK-' . time(),
            'book_category_id' => $this->faker->numberBetween(1, 50),
            'judul_buku' => $this->faker->sentence(3),
            'nama_pengarang' => $this->faker->name(),
            'nama_penerbit' => $this->faker->company(),
            'tahun_terbit' => $this->faker->year(),
            'jumlah_buku' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
        ];
    }
}
