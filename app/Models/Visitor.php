<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'ip'];

    // Many visitors belong to one blog
    public function blog() {
        return $this->belongsTo('App\Models\Blog');
    }

}
