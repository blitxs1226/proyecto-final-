<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nodo extends Model
{
    use HasFactory;

    protected $table = 'nodo';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function raices(){
        return $this->hasMany('App\Models\Edge','Raiz', 'id');
    }

    public function dirigidos(){
        return $this->hasMany('App\Models\Edge','Dirigido', 'id');
    }
}


