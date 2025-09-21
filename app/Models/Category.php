<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name'];

    //A categoy hasMany todos
    // current model category many category hasMany with single todo    
    public function todos(){
            return $this->hashMany(Todo::class);
    }
}
