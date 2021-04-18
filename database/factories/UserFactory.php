<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->id(),
            'userType'=>$this->faker->randomElement($array = array ('Admin','Agent','Buyer','')),
            'email'=>$this->faker->unique()->safeEmail,
            'userName'=>$this->faker->unique()->name,
            'email_verified_at'=>$this->faker->datetime,
            'password'=>$this->faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
            //'remember_token' => Str::random(10),
            'created_at'=>$this->faker->datetime,
            'updated_at'=>$this->faker->datetime,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
