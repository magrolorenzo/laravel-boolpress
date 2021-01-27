<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = [
        'author',
        'title',
        'body',
        'slug',
        'date'
    ];
}
