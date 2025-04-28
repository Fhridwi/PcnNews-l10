<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleMedia extends Model
{
    use HasFactory;

    protected $table = 'article_media';

    public $timestamps = false; 

    protected $fillable = ['article_id', 'media_id', 'role', 'sort_order'];
}
