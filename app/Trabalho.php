<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model
{
    protected $fillable = ['titulo','descricao','orientador_id','tema_id','user_id'];
    
    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orientador()
    {
        return $this->belongsTo(User::class);
    }
}
