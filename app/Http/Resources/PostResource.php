<?php


namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PostResource extends JsonResource
{
/**
* Transform the resource into an array.
*/
public function toArray(Request $request): array
{
return [
'id' => $this->id,
'title' => $this->title,
'body' => $this->body,
'author_name' => $this->author_name,
'created_at' => $this->created_at->toDateTimeString(),
'updated_at' => $this->updated_at->toDateTimeString(),
'comments' => CommentResource::collection($this->whenLoaded('comments')),
];
}
}