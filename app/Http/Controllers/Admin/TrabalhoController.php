<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tema;
use App\Trabalho;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;

class TrabalhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $trabalhos = Trabalho::select('*')->paginate(5);
        $orientadores = User::getOrientadores();
        $temas = Tema::all();

        return view('admin.trabalho.index',compact('user','trabalhos','orientadores','temas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->status == 0){
            return view('admin.usuario.blocklist',compact('user'));
        }else{


            $temas = Tema::all();
            $professores = User::getOrientadores();
            return view('admin.trabalho.create',compact('user','temas','professores'));

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    

    public static function store(Request $req)
    {
        $user = Auth::user();
        $data = [
            'titulo' => $req->titulo,
            'descricao' => $req->descricao,
            'user_id' => $user->id,
            'orientador_id' => $req->orientador_id,
            'tema_id' => $req->tema_id
        ];

        $trabalho = Trabalho::create($data);
        Toastr::success('trabalho criado com sucesso');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        $user = Auth::user();
        $trabalho = Trabalho::find($req->trabalho_id);
        return view('admin.trabalho.show',compact('user','trabalho'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        $user = Auth::user();
        $orientadores = User::getOrientadores();
        $temas = Tema::all();
        $trabalho = Trabalho::find($req->trabalho_id);

        return view('admin.trabalho.edit',compact('user','orientadores','temas','trabalho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $data = [
            'titulo' => $req->titulo,
            'descricao' => $req->descricao,
            'tema_id' => $req->tema_id,
            'orientador_id' => $req->orientador_id
        ];

        $old_trabalho = Trabalho::find($req->trabalho_id);

        $old_trabalho->update($data);

        Toastr::success('Trabalho editado com sucesso');
        return redirect()->route('trabalho.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {
        $trabalho = Trabalho::find($req->trabalho_id);
        $trabalho->delete();
        Toastr::success('Trabalho excluido com sucesso');
        return redirect()->back();
    }

    public function semOrientador()
    {
        $user = Auth::user();
        $trabalhos = Trabalho::where('orientador_id',null)->get();
        return view('admin.trabalho.semorientador',compact('user','trabalhos'));
    }

    public function trabalhosPendentes()
    {
        $user = Auth::user();
        return view('admin.trabalho.pendentes',compact('user'));
    }

    public function search(Request $req)
    {
        $filters = [
            'titulo' => $req->titulo_trabalho,
            'orientador_id' => $req->orientador_id,
            'tema_id' => $req->tema_id
        ];
        $trabalhos = Trabalho::search($filters)->paginate(5);
        $orientadores = User::getOrientadores();
        $temas = Tema::all();
        $user = Auth::user();

        return view('admin.trabalho.index',compact('trabalhos','orientadores','temas','user','filters'));
    }
}
