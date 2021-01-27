<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function category(){
        return $this->belongsTo("App\Category");
    }

    public $fillable = [
        'author',
        'title',
        'body',
        'slug',
        'category_id',
        'date'
    ];
}
