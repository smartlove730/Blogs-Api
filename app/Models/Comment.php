<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
use HasFactory;


protected $fillable = ['post_id', 'user_name', 'content'];


/**
* Relationship: A Comment belongs to a Post
*/
public function post()
{
return $this->belongsTo(Post::class);
}
}