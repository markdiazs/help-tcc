<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tema;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class TemaController extends Controller
{

    
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
            return redirect()->back();
        }else{
            $tema = Tema::create([
                'titulo' => $req->tema_title
            ]);
            Toastr::success('Tema cadastrado');
            return redirect()->back()->with('tema',$tema);
        }


        
    }
}
