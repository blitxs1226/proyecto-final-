<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Edge extends Model
{

    protected $table = 'edge';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function rRaiz()
    {
        return $this->hasOne('App\Models\Nodo', 'id', 'Raiz');
    }

    public function rDirigido()
    {
        return $this->hasOne('App\Models\Nodo', 'id', 'Dirigido');
    }
}
