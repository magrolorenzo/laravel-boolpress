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
        "cover",
        'category_id',
        'date'
    ];

    public function category(){
        return $this->belongsTo("App\Category");
    }

    public function tags(){
        return $this->belongsToMany("App\Tag");
    }

}
