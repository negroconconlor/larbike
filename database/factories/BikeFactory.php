<?php

namespace Database\Factories;

use App\Models\Bike;
use Illuminate\Database\Eloquent\Factories\Factory;

class BikeFactory extends Factory
{
    // The name of the factory's corresponding model. 
    protected $model = Bike::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'marca' => $this->faker->randomElement([
                'Honda', 'Kawasaki', 'Ducati', 'Derbi', 'KTM', 'Aprilia', 
                'BMW', 'Yamaha', 'Bultaco', 'Suzuki', 'Triumph', 'Kymco'
            ]),
            'modelo' => $this->faker->word(),
            'kms'=> $this->faker->numberBetween(0, 1000000000),
            'precio'=> $this->faker->randomFloat(0, 1000, 50000),
            'matriculada' => $this->faker->boolean
        ];
    }
}
