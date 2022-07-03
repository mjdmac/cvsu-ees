<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => factory('App\User')->create()->id,
            'fname' => $this->faker->name(),
            'mname' => $this->faker->name(),
            'lname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'birthday' => $this->faker->date('Y-m-d'),
            'phone_number' => $this->faker->numerify('63########'),


            'password' => bcrypt('changetorandomstring'), // password
        ];
    }
}
