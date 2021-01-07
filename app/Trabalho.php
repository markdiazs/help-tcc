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

    public static function search($filters = [])
    {
        $result = Trabalho::where(function($query) use ($filters){
            if($filters['titulo'] && $filters['orientador_id'] == null && $filters['tema_id'] == null){
                $query->where('titulo',$filters['titulo']);
            }
            if($filters['orientador_id'] != null && $filters['titulo'] == null && $filters['tema_id'] == null){
                $query->where('orientador_id',$filters['orientador_id']);
            }
            if($filters['tema_id'] != null && $filters['orientador_id'] == null && $filters['titulo'] == null){
                $query->where('tema_id',$filters['tema_id']);
            }
            if($filters['tema_id'] != null && $filters['orientador_id'] != null && $filters['titulo'] != null){
                $query->where($filters);
            }
            if($filters['tema_id'] != null && $filters['orientador_id'] != null && $filters['titulo'] == null){
                $query->where('tema_id',$filters['tema_id'])
                ->where('orientador_id',$filters['orientador_id']);
            }
            if($filters['tema_id'] == null && $filters['orientador_id'] != null && $filters['titulo'] != null){
                $query->where('orientador_id',$filters['orientador_id'])
                ->query->where('titulo',$filters['titulo']);
            }
            if($filters['tema_id'] != null && $filters['orientador_id'] == null && $filters['titulo'] != null){
                $query->where('titulo',$filters['titulo'])
                ->where('tema_id',$filters['tema_id']);
            }
        });

        return $result;
    }
}
