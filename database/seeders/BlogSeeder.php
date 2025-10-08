<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;


class BlogSeeder extends Seeder
{
public function run(): void
{
// Create 10 posts, each with 3 comments
Post::factory(10)
->has(Comment::factory(3))
->create();
}
}