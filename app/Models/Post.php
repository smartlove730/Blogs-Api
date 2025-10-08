<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
use HasFactory, SoftDeletes;


protected $fillable = ['title', 'body','author_name'];


/**
* Relationship: A Post can have many Comments
*/
public function comments()
{
return $this->hasMany(Comment::class);
}


/**
* Scope: Search posts by title or body
*/
public function scopeSearch($query, $term)
{
if (! $term) return $query;


$term = "%" . strtolower($term) . "%";


return $query->whereRaw('LOWER(title) LIKE ?', [$term])
->orWhereRaw('LOWER(body) LIKE ?', [$term]);
}
}