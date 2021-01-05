<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tema extends Model
{
    protected $fillable = ['titulo'];

    public function trabalhos()
    {
        return $this->belongsToMany(Trabalho::class);
    }
}
