<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "client_name"   =>  $this->faker->company(),
            "short_name"    =>  $this->faker->companySuffix(),
            "address"       =>  $this->faker->address(),
            "kra_pin"       =>  $this->faker->unique()->creditCardNumber(),
            "goods_description" =>  $this->faker->sentence(),
            "contact_person"    =>  json_encode([
                "name"  =>  $this->faker->name(),
                "phone" =>  $this->faker->phoneNumber(),
                "email" =>  $this->faker->unique()->safeEmail()
            ]),
            "logo"  =>  $this->faker->imageUrl()
        ];
    }
}
