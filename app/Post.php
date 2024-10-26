<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Post extends Model {

    use HasSoftDelete;

    protected $table = "posts";
    protected $fillable = ['title', 'body', 'cat_id', 'image', 'user_id', 'status', 'published_at'];
    protected $casts = ['image' => 'array'];

    public function category(){
        return $this->belongsTo('\App\Category', 'cat_id', 'id');
    }

    public function user(){
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

}