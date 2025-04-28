<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_categories', 'categories_id', 'article_id');
    }
    

}
