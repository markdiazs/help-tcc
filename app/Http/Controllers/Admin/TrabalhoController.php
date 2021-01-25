<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tema;
use App\Trabalho;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class TrabalhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        
     }


    public function index()
    {
        $user = Auth::user();
        $trabalhos = Trabalho::select('*')->paginate(7);
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
     
        if(Gate::denies('trabalho-create')){
            abort(403, "Não autorizado");
        }

        $user = Auth::user();
        $count = 0;
        $alunos = null;
        foreach($user->papeis as $p){
            if($p->nome == "Professor" || $p->nome == "Coordenador" || $p->nome == "Admin"){
                $count++;
                $alunos = User::whereHas('papeis', function($query){
                    $query->where('nome','=','Aluno');
                })->get();
            }
        }



        if($user->status == 0){
            return view('admin.usuario.blocklist',compact('user'));
        }else{


            $temas = Tema::all();
            $professores = User::getOrientadores();
            return view('admin.trabalho.create',compact('user','temas','professores','alunos'));

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

        if(Gate::denies('trabalho-create')){
            abort(403, "Não autorizado");
        }

        $user = Auth::user();
        $data = [];
        //Model User
        $usermodel = User::find($user->id);
        //
        $count = 0;

        foreach($usermodel->papeis as $p){
            if($p->nome == "Admin" || $p->nome == "Professor" || $p->nome == "Coordenador"){
                $count++;
            }
        }

        if($count > 0){

            $rules = [
                'titulo' => 'required|min:10',
                'tema_id' => 'required',
                'aluno_id' => 'required',
                'descricao' => 'required'
            ];
    
            $validator = Validator::make($req->all(),$rules, $messages = [
                'required' => 'O campo é obrigatório',
                'min' => 'O campo precisa conter pelo menos 10 caracteres'
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

        }else{
            $rules = [
                'titulo' => 'required|min:10',
                'tema_id' => 'required',
                'descricao' => 'required'
            ];
    
            $validator = Validator::make($req->all(),$rules, $messages = [
                'required' => 'O campo é obrigatório',
                'min' => 'O campo precisa conter pelo menos 10 caracteres'
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if($req->aluno_id != null){
            $data = [
                'titulo' => $req->titulo,
                'descricao' => $req->descricao,
                'user_id' => $req->aluno_id,
                'orientador_id' => $req->orientador_id,
                'tema_id' => $req->tema_id
            ];
        }else{
            $data = [
                'titulo' => $req->titulo,
                'descricao' => $req->descricao,
                'user_id' => $user->id,
                'orientador_id' => $req->orientador_id,
                'tema_id' => $req->tema_id
            ];
        }

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
        $user = User::find(Auth::user()->id);
        $trabalho = Trabalho::find($req->trabalho_id);

        return view('admin.trabalho.show',compact('user','trabalho'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find(Auth::user()->id);
        $orientadores = User::getOrientadores();
        $temas = Tema::all();
        $trabalho = Trabalho::find($id);
        $aluno = false;
        $admin = false;

        foreach($user->papeis as $p){
            if($p->nome == "Aluno"){
                $aluno = true;
            }elseif($p->nome == "Admin"){
                $admin = true;
            }
        }

        if(!$admin){
            if($aluno){
                if(Gate::denies('trabalho-edit') || $trabalho->user_id != $user->id){
                    abort(403,"Não autorizado");
                }
            }elseif(Gate::denies('trabalho-edit') || $trabalho->orientador_id != $user->id){
                    abort(403,"Não autorizado");
            }

        }

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

        $user = User::find(Auth::user()->id);
        $trabalho = Trabalho::find($req->trabalho_id);
        $aluno = false;
        $admin = false;

        foreach($user->papeis as $p){
            if($p->nome == "Aluno"){
                $aluno = true;
            }elseif($p->nome == "Admin"){
                $admin = true;
            }
        }

        if(!$admin){
            if($aluno){
                if(Gate::denies('trabalho-edit') || $trabalho->user_id != $user->id){
                    abort(403,"Não autorizado");
                }
            }elseif(Gate::denies('trabalho-edit') || $trabalho->orientador_id != $user->id){
                    abort(403,"Não autorizado");
            }

        }

        $rules = [
            'titulo' => 'required|min:10',
            'tema_id' => 'required',
            'descricao' => 'required'
        ];

        $validator = Validator::make($req->all(),$rules, $messages = [
            'required' => 'O campo é obrigatório',
            'min' => 'O campo precisa conter pelo menos 10 caracteres'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


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
        $user = User::find(Auth::user()->id);
        $trabalho = Trabalho::find($req->trabalho_id);
        $count = 0;
        $aluno = false;
        $admin = false;
        foreach($user->papeis as $p){
            if($p->nome == "Professor" || $p->nome == "Coordenador" || $p->nome = "Admin" && URL::previous() == route('usuario.myjobs') && $trabalho->user_id != $user->id){
                $count += 1;
                // var_dump($count);
                // exit();
            }
            if($p->nome == 'Aluno'){
                $aluno = true;
            }
            if($p->nome == 'Admin'){
                $admin = true;
            }
        }


        $trabalho = Trabalho::find($req->trabalho_id);

        if($count <= 0){
            if(!$admin){
                if(!$aluno){
                    if (Gate::denies('trabalho-delete') || $user->id != $trabalho->orientador_id && $trabalho->user_id != $user->id) {
                        abort(403, "Não autorizado");
                    }
                }else{
                    if(Gate::denies('trabalho-delete') || $user->id != $trabalho->user_id && $trabalho->orientador_id != $user->id){
                        abort(403, "Não autorizado");
                    }
                }
            }
            $trabalho->delete();
            Toastr::success('Trabalho excluido com sucesso');
        }else{
            $trabalho->update(['orientador_id' => null]);
            Toastr::success('Você deixou de orientar esse projeto');
        }

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
        $trabalhos = Trabalho::search($filters)->paginate(7);
        $orientadores = User::getOrientadores();
        $temas = Tema::all();
        $user = Auth::user();
        return view('admin.trabalho.index',compact('trabalhos','orientadores','temas','user','filters'));
    }
}
