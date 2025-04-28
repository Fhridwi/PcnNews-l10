<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'summary', 'content', 'cover_image_url', 'publish_status', 'published_at', 'author_id', 'view_count'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'article_categories', 'article_id', 'categories_id');
    }


    

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'article_media')->withPivot('role', 'sort_order');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}
