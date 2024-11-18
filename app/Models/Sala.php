<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id'; 
    protected $fillable = ['pelicula','enlaceImg','sinopsis'];

    public function asientos(){
        return $this->hasMany(Asiento::class,'idSala');
    }
}
