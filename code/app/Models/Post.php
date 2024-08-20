<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected $with = ['author'];
    protected $fillable = [
        'title',
        'body',
        'author_id',
        'category_id',
        'publish_at'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    protected static function booted(): void
    {
        static::creating(function(Post $post) {
            $post->slug = Str::slug($post->title . '-' . $post->author?->first_name . '-' . $post->author?->last_name);
        });
    }

    /***************************************************************************
     *                                                                         *
     *                             Model Relationships                         *
     *                                                                         *
     ***************************************************************************/
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
         return $this->hasMany(Comment::class, 'post_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    //@TODO
    public function tags()
    {
    }

}
