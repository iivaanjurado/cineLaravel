<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id'; 
    protected $fillable = ['pelicula'];
    // Ocultar los campos created_at y updated_at no se incluirán en las respuestas JSON generadas por Eloquent
    protected $hidden = ['created_at', 'updated_at'];

    public function asientos(){
        return $this->hasMany(Asiento::class,'idSala');
    }
}
