<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'location', 'code'];
    public function section_theme(){
        return $this->hasMany(Theme::class); //1 to n
    }
}
