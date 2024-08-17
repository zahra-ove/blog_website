<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = ['title', 'body', 'author_id', 'category_id', 'publish_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //@TODO
    public function comments()
    {
    // return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    //@TODO
    public function tags()
    {

    }

}
