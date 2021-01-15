<?php

namespace App;

use App\Notifications\leaderForStudent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status','codigo','turma','whatsapp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function eAdmin()
    {
        // return $this->id == 1;
        return $this->existePapel('Admin');
    }

    public function papeis()
    {
        return $this->belongsToMany(Papel::class);
    }

    public function trabalhos()
    {
        return $this->hasMany(Trabalho::class);
    }

    public function mentoria()
    {
        return $this->hasMany(Trabalho::class);
    }

    public function adicionaPapel($papel)
    {
        if (is_string($papel)) {
            $papel = Papel::where('nome','=',$papel)->firstOrFail();
        }

        if($this->existePapel($papel)){
            return;
        }

        return $this->papeis()->attach($papel);

    }
    public function existePapel($papel)
    {
        if (is_string($papel)) {
            $papel = Papel::where('nome','=',$papel)->firstOrFail();
        }

        return (boolean) $this->papeis()->find($papel->id);

    }
    public function removePapel($papel)
    {
        if (is_string($papel)) {
            $papel = Papel::where('nome','=',$papel)->firstOrFail();
        }

        return $this->papeis()->detach($papel);
    }

    public function temUmPapelDestes($papeis)
    {
      $userPapeis = $this->papeis;
      return $papeis->intersect($userPapeis)->count();
    }

    public static function searchFilter($data = [])
    {
        // if(count($data) != 0){
        //    User::whereHas('papeis',function($query) use ($data){
        //     return $query->where('id','=',$data['papel_id']);
        //    });
        // }
            $users = User::whereHas('papeis', function($query) use ($data){
                if($data['papel_id'] != null){
                    $query->where('id','=',$data['papel_id']);
                }
                if($data['name'] != null){
                    $query->where('name','LIKE',"%{$data['name']}%");
                }
                if($data['email'] != null) {
                    $query->where('email','=',$data['email']);
                }
                if($data['name'] != null && $data['email'] != null && $data['papel_id'] != null){
                    $query->where('id','=',$data['papel_id'])
                    ->where('name','LIKE',"%{$data['name']}%")
                    ->where('email','=',$data['email']);
                }
           });
        return $users;
    }

    public static function getOrientadores()
    {
        $orientadores = User::whereHas('papeis', function($query){
            $query->where('nome','=','Coordenador')->orWhere('nome','=','Professor');
        })->get();
        return $orientadores;
    }


    public  function addTrabalho($trabalho)
    {
        if($trabalho != null){
            $this->trabalhos()->attach($trabalho);
        }
    }


    //notificando user
    public function notifyStudentAboutLead( User $lead)
    {
        return $this->notify(new leaderForStudent($lead));
    }
}
