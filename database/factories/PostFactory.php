<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;


/**
* @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
*/
class PostFactory extends Factory
{
public function definition(): array
{
return [
'title' => $this->faker->unique()->sentence(5),
'body' => $this->faker->paragraphs(3, true),
'author_name' => $this->faker->name(3, true),
];
}
}