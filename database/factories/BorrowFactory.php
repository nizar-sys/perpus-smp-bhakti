<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'buku_id' => $this->faker->randomNumber(),
            'peminjam_id' => $this->faker->randomNumber(),
            'petugas_id' => $this->faker->randomNumber(),
            'tanggal_pinjam' => $this->faker->date(),
            'status' => $this->faker->randomElement(["dipinjam","dikembalikan"]),
        ];
    }
}
