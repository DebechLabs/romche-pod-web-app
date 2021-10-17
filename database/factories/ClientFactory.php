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
        $contactPersons = [];

        $loops = rand(0, 10);
        if ($loops > 0){
            for($i = 0; $i < $loops; $i++){
                $contactPersons[] = [
                    "name"  =>  $this->faker->name(),
                    "phone" =>  $this->faker->phoneNumber(),
                    "email" =>  $this->faker->unique()->safeEmail()
                ];
            }
        }
        return [
            "client_name"   =>  $this->faker->company(),
            "short_name"    =>  $this->faker->companySuffix(),
            "address"       =>  $this->faker->address(),
            "kra_pin"       =>  $this->faker->unique()->creditCardNumber(),
            "goods_description" =>  $this->faker->sentence(),
            "contact_person"    =>  json_encode($contactPersons),
            "logo"  =>  $this->faker->imageUrl()
        ];
    }
}
