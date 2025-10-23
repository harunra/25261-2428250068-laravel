<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'code', 'number of books', 'theme_id'];
    public function book_theme(){
        return $this->belongsTo(Theme::class,'theme_id','id');
    }
}
