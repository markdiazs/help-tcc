<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendmailCreateUser;
use App\Mail\SendmailTeacherProject;
use App\Mail\SendmailUpdateUser;
use App\Papel;
use App\Tema;
use App\Trabalho;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yoeunes\Toastr\Facades\Toastr;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     

    public function userBlock()
    {
        $user = Auth::user();
        $users = DB::table('users')->where('status','0')->get();
        return view('admin.usuario.block',compact('user','users'));
    }

    public function index()
    {
        $users = User::select('*')->paginate(7);
        $papeis = Papel::all();
        $user = Auth::user();
        return view('admin.usuario.index',compact('user','users','papeis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $papeis = Papel::all();
        return view('admin.usuario.create',compact('user','papeis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = Str::random(8);
        $data = [
            'name' => $request['user_name'],
            'email' => $request['user_email'],
            'codigo' => $request['user_codigo'],
            'turma' => $request['user_turma'],
            'whatsapp' => $request['user_whatsapp'],
            'password' => Hash::make($password)
        ];
        $user = User::create($data);
        $user->password = $password;
         if( $user != null){
            $this->papelStore($request['user_papel'],$user->id);
            Mail::to($user->email)->cc('contatohelptcc@gmail.com')->send(new SendmailCreateUser($user));
         }

         toastr()->success('usuário criado com sucesso');
         return redirect()->back();
    }


    public function block(Request $req)
    {   
        $data = $req->all();
        DB::table('users')->where('id', $req['user_id'])->update(['status' => '0']);

        toastr()->success('usuário bloqueado com sucesso');
        return redirect()->back();
    }
    public function desblock(Request $req)
    {   
        $data = $req->all();
        DB::table('users')->where('id', $req['user_id'])->update(['status' => '1']);

        toastr()->success('Usuário Desbloqueado com sucesso');
        return redirect()->back();
    }

    public function blacklist()
    {
        return view('admin.usuario.blacklist');
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
        $trabalhos = Trabalho::where('user_id','=',$user->id)->orWhere('orientador_id','=',$user->id)->get()->count();
        return view('admin.usuario.show',compact('user','trabalhos'));
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
        $papeis = Papel::all();
        $user_edit = User::find($req['user_id']);
        return view('admin.usuario.edit',compact('user','papeis','user_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'name' => $request['user_name'],
            'email' => $request['user_email'],
            'codigo' => $request['user_codigo'],
            'turma' => $request['user_turma'],
            'whatsapp' => $request['user_whatsapp'],
        ];
        
        $old_user = User::find($request['user_id']);
        $old_user->update($data);
        if($old_user->papeis()->get()->count() > 0)
            foreach($old_user->papeis()->get() as $p){
                if( $p->id != $request['user_papel']){
                    $this->papelDestroy($old_user->id,$p->id);
                    $this->papelStore($request['user_papel'],$old_user->id);
                }
            }
        else {
            $this->papelStore($request['user_papel'],$old_user->id);
        }

        toastr()->success('Usuário editado com sucesso');
        return redirect()->route('usuario.index');
        
    }

    public function editmyperfil()
    {
        $user = User::find(Auth::user()->id);

        return view('admin.usuario.update',compact('user'));
    }

    public function updateMyPerfil(Request $req)
    {

        $this->validate($req,[
            'user_password' => 'required'
        ]);

        $user = User::find(Auth::user()->id);
        $count = 0;

           if(!Hash::check($req->user_password,Auth::user()->password)){
                Toastr::error('A senha digitada está incorreta');
                return redirect()->route('usuario.editmyperfil');
           } 

        if($req->new_password != null || $req->confirm_password !=null){
            if($req->new_password != $req->confirm_password){
                Toastr::error('senhas não conferem');
                return redirect()->route('usuario.editmyperfil');
            }
        }

        $data = [
            'name' => $req->user_name,
            'email' => $req->user_email,
            'whatsapp' => $req->user_whatsapp,
            'password' => Hash::make($req->new_password)
        ];

        foreach($data as $key => $value){
            if($value != null){
                $user->update([$key => $value]);
                $count++;
            }
        }

        if($count > 0){
            Mail::to($data['email'])->cc('contatohelptcc@gmail.com')->send(new SendmailUpdateUser($user));
            Toastr::success('Informações atualizadas');
            return redirect()->route('usuario.perfil');
        }
        Toastr::error('Houve algum erro ao atualizar o seu perfil');
        return redirect()->route('usuario.editmyperfil');   
    }

    public function editMyJob(Request $req)
    {
        $user = Auth::user();
        $orientadores = User::getOrientadores();
        $temas = Tema::all();
        $trabalho = Trabalho::find($req->trabalho_id);

        return view('admin.usuario.editmyjob',compact('user','orientadores','temas','trabalho'));
    }

    public function updateMyJob(Request $req)
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
        return redirect()->route('usuario.myjobs');
    }

    public function searchFilter(Request $req)
    {
        $data = [
            'name' => $req['user_nome'],
            'email' => $req['user_email'],
            'papel_id' => $req['user_papel']
        ];
        $filters = $data;
        $user = Auth::user();
        $papeis = Papel::all();
        $users = User::searchFilter($data)->paginate(5);

        if (count($users) <= 0){

            toastr()->error('Nenhum registro encontado');
        }
        
        return view('admin.usuario.index',compact('users','user','papeis','filters'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $user = User::findOrFail($req['user_id']);
        $user->delete();
        toastr()->success('Usuário excluído com sucesso');
        return redirect()->back();
    }


    public function myJobs()
    {
        $user = Auth::user();
        $userModel = User::find($user->id);
        $trabalhos = Trabalho::where('user_id',$userModel->id)->orWhere('orientador_id',$userModel->id)->get();
        return view('admin.usuario.myjobs',compact('user','trabalhos'));
    }

    public function papelStore($papel_id,$user_id)
    {
        $usuario = User::find($user_id);
        $papel = Papel::find($papel_id);
        $usuario->adicionaPapel($papel);
    }

    public function papelDestroy($id,$papel_id)
    {
        $usuario = User::find($id);
        $papel = Papel::find($papel_id);
        $usuario->removePapel($papel);
        return redirect()->back();
    }

    public function orientarProject(Request $req)
    {
        $orientador = Auth::user();
        $autor = User::find($req->autor_id);
        $trabalho = Trabalho::find($req->trabalho_id);

        if($trabalho->update(['orientador_id' => $orientador->id])){
            Mail::to($autor->email)->cc('contatohelptcc@gmail.com')->send(new SendmailTeacherProject($orientador));
        }
        Toastr::success('O projeto foi adicionado a sua lista');
        return redirect()->back();

    }

}
