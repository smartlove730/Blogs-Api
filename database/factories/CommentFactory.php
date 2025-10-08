<?php


namespace Database\Factories;


use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
* @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
*/
class CommentFactory extends Factory
{
public function definition(): array
{
return [
'post_id' => Post::factory(), // automatically creates related post if not provided
'user_name' => $this->faker->name(),
'content' => $this->faker->paragraph(),
];
}
}