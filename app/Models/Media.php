<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['file_path', 'file_type', 'file_size', 'alt_text', 'uploaded_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_media')->withPivot('role', 'sort_order');
    }
}
