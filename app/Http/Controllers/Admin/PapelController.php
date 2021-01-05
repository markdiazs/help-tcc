<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Papel;
use App\Permissao;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $papeis = Papel::where('nome','!=','Admin')->get();
        return view('admin.papel.index',compact('user','papeis'));
    }

    public function permissao($id)
    {
        $user = Auth::user();
        $papeis = Papel::where('nome','!=','Admin')->get();
        $papel = Papel::find($id);
        $permissao = Permissao::all();
        return view('admin.papel.permissao',compact('user','papeis','papel','permissao'));
    }

    public function permissaoStore(Request $request)
    {
        $papel = Papel::find($request['papel_id']);
        $dados = $request->all();
        $permissao = Permissao::find($dados['permissao_id']);
        $papel->adicionaPermissao($permissao);
        toastr()->success('Permissão desbloqueada');
        return redirect()->back();
    }

    public function permissaoDestroy(Request $request)
    {
      $papel = Papel::find($request['papel_id']);
      $permissao = Permissao::find($request['permissao_id']);
      $papel->removePermissao($permissao);
      toastr()->success('Permissão bloqueada');
      return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
