<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'category_id'];

    protected static function booted(): void
    {
        static::creating(fn(Category $category) => Str::slug($category->name));
    }


    /***************************************************************************
     *                                                                         *
     *                             Model Relationships                         *
     *                                                                         *
     ***************************************************************************/

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
