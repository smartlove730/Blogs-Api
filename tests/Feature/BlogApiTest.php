<?php
 


namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;


class BlogApiTest extends TestCase
{
use RefreshDatabase;

/** @test */
public function it_can_create_a_post()
{
$data = [
'title' => 'Test Post',
'author_name' => 'john smith',
'body' => 'This is a test post body.',
];


$response = $this->postJson('/api/posts', $data);


$response->assertStatus(201)
->assertJsonFragment(['title' => 'Test Post']);


$this->assertDatabaseHas('posts', ['title' => 'Test Post']);
}


/** @test */
public function it_can_list_posts()
{
Post::factory()->count(3)->create();


$response = $this->getJson('/api/posts');


$response->assertStatus(200)
->assertJsonStructure(['data', 'links', 'meta']);
}


/** @test */
// public function it_can_show_a_single_post_with_comments()
// {
// $post = Post::factory()->create();
// Comment::factory()->count(2)->create(['post_id' => $post->id]);


// $response = $this->getJson('/api/posts/' . $post->id);


// $response->assertStatus(200)
// ->assertJsonStructure(['id','title','body','comments']);
// }

/** @test */
public function it_can_show_a_single_post_with_comments()
{
    $post = Post::factory()->create();
    Comment::factory()->count(2)->create(['post_id' => $post->id]);

    $response = $this->getJson('/api/posts/' . $post->id);

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     'id',
                     'title',
                     'body',
                     'author_name',
                     'comments' => [
                         '*' => ['id','post_id','user_name','content','created_at','updated_at']
                     ]
                 ]
             ]);
}


/** @test */
public function it_can_add_a_comment_to_a_post()
{
$post = Post::factory()->create();


$data = [
'user_name' => 'John Doe',
'content' => 'Nice post!',
];


$response = $this->postJson('/api/posts/' . $post->id . '/comments', $data);


$response->assertStatus(201)
->assertJsonFragment(['user_name' => 'John Doe']);


$this->assertDatabaseHas('comments', ['user_name' => 'John Doe']);
}


/** @test */
public function it_can_delete_a_comment()
{
$comment = Comment::factory()->create();


$response = $this->deleteJson('/api/comments/' . $comment->id);


$response->assertStatus(200)
->assertJson(['message' => 'Comment deleted successfully.']);


$this->assertDatabaseMissing('comments', ['id' => $comment->id]);
}
}