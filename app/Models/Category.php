<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function categories(){
        return $this->hasMany('App\Models\Category','parent_id');
    }
    public function parent(){
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function getParentsNames() {
        if($this->parent) {
            // return $this->parent->getParentsNames(). " > " . $this->name;
            return $this->parent->getParentsNames();
        } else {
            return $this->name;
        }
    }
}
