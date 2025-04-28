<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $primaryKey = 'setting_key';
    public $incrementing = false;
    protected $fillable = ['setting_key', 'setting_value'];

    public $timestamps = true;
}
