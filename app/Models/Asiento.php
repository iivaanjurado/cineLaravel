<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $fillable=['fila','columna','reservado','idSala'];

    public function sala(){
        return $this->belongsTo(Sala::class,'idSala');
    }

}
