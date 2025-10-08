<?php


namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CommentResource extends JsonResource
{
/**
* Transform the resource into an array.
*/
public function toArray(Request $request): array
{
return [
'id' => $this->id,
'post_id' => $this->post_id,
'user_name' => $this->user_name,
'content' => $this->content,
'created_at' => $this->created_at->toDateTimeString(),
'updated_at' => $this->updated_at->toDateTimeString(),
];
}
}