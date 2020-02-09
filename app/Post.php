<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'image', 'category_id',];
//delete view
    protected $dates = ['deleted_at'];
    public function getImageAttribute($image){
        return asset($image);
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
