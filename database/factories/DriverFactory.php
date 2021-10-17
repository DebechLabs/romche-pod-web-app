<?php

namespace Database\Factories;

use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' =>  $this->faker->lastName,
            'other_names'   =>  $this->faker->firstName,
            'phone_number'  =>  $this->faker->phoneNumber,
            'email_address' =>  $this->faker->email,
            'kra_pin'       =>  $this->faker->unique()->creditCardNumber,
            'license_no'    =>  $this->faker->unique()->word,
            'date_of_birth' =>  $this->faker->date('Y-m-d', Carbon::now()->subYears(18))
        ];
    }
}
