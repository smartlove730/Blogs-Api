<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException; 

class PostController extends Controller
{
/**
* Display a listing of the posts with pagination and search.
* GET /api/posts?search=keyword
*/
public function index(Request $request)
{
$search = $request->query('search');
 

$posts = Post::query()
->search($search)
->latest()
->paginate(5)
->withQueryString();


return $this->successResponse($posts);
}


/**
* Store a newly created post.
* POST /api/posts
*/
public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('posts')],
            'author_name' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);
    } catch (ValidationException $e) {
        // Return validation errors in JSON format
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422)
        );
    }

    $post = Post::create($validated);

    return   $this->successResponse($post);
}


/**
* Display the specified post along with comments.
* GET /api/posts/{id}
*/
public function show($id)
{
    $post = Post::with('comments')->find($id);

    if (! $post) {
        return $this->notFoundResponse('Post not found');
    }

   return $this->successResponse($post);
}


public function destroy($id)
{
    $post = Post::find($id);

    if (! $post) {
         return $this->notFoundResponse('Post not found');
    }

    $post->delete(); // Soft delete

  return   $this->successResponse($post);
}

}