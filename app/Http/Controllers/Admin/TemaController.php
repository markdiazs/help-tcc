<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tema;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class TemaController extends Controller
{

    
    public function __construct()
    {
      
    }

    public function store(Request $req)
    {
        $temas = Tema::all();
        $count = 0;
        foreach($temas as $t){
            if(Str::lower($t->titulo) == Str::lower($req->tema_title)){
                $count += 1;
            }
        }
        if( $count > 0){

            Toastr::error('Tema Duplicado');
            return json_encode(0);
        }else{
            
            $tema = Tema::create([
                'titulo' => $req->tema_title
            ]);
            // $tema = Tema::find(1);
            Toastr::success('Tema cadastrado');
            return([$tema->id, $tema->titulo]);
        }


        
    }
}
