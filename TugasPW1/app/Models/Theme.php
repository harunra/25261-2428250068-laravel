<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
     protected $fillable = ['name', 'code', 'section_id'];
    public function theme_section(){  
        return $this->belongsTo(Section::class,'section_id','id');//1 ke 1
    }
    public function theme_book(){
        return $this->hasMany(Book::class);
    }
}
