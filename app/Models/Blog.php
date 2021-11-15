<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'url', 'image', 'image_alt', 'meta', 'short_description', 'description', 'active'];

    // Blogs Belong to User
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    // Blogs belong to Category
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    // Blog has many Tags
    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }

}
