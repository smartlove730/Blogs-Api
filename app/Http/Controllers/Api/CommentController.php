<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
/**
* Store a newly created comment for a given post.
* POST /api/posts/{id}/comments
*/
public function store(Request $request, $postId)
{
$post = Post::findOrFail($postId);


$validated = $request->validate([
'user_name' => ['required', 'string'],
'content' => ['required', 'string'],
]);


$comment = $post->comments()->create($validated);


return (new CommentResource($comment))
->response()
->setStatusCode(201);
}


/**
* Remove the specified comment from storage.
* DELETE /api/comments/{id}
*/
public function destroy($id)
{
$comment = Comment::findOrFail($id);
$comment->delete();


return response()->json(['message' => 'Comment deleted successfully.'], 200);
}
}