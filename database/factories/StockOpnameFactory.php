<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockOpname>
 */
class StockOpnameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'buku_id' => $this->faker->numberBetween(1, 100),
            'tanggal' => $this->faker->date(),
            'keterangan' => $this->faker->text(),
            'jumlah_buku' => $this->faker->numberBetween(1, 10),
        ];
    }
}
