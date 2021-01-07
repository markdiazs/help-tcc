@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-edit"></i></h3>
              </div>
              <div class="card-body">
              <form action="{{route('usuario.update')}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" value="{{$user_edit->id}}" name="user_id">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="user_name">Nome Completo:</label>
                      <input class="form-control form-control-sm" type="text" id="user_name" name="user_name" placeholder="nome completo" value="{{$user_edit->name}}">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="user_email">E-mail:</label>
                      <input class="form-control form-control-sm" type="email" id="user_email" name="user_email" placeholder="email para contato" value="{{$user_edit->email}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="user_name">Tipo de perfil:</label>
                      <select class="form-control form-control-sm" name="user_papel" id="user_papel" name="user_papel">
                        @foreach($papeis as $p)
                        @if($user_edit->papeis()->get()->count() > 0)
                            @foreach($user_edit->papeis()->get() as $pp)
                            @if($p->id == $pp->id)
                            <option selected value="{{$p->id}}">{{$p->nome}}</option>
                            @else 
                            <option value="{{$p->id}}">{{$p->nome}}</option>
                            @endif
                            @endforeach
                        @else
                        <option value="{{$p->id}}">{{$p->nome}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="user_email">Código:</label>
                      <input class="form-control form-control-sm" type="text" id="user_codigo" name="user_codigo" placeholder="Matricula/Código" value="{{$user_edit->codigo}}">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="user_email">Turma:</label>
                      <input class="form-control form-control-sm" type="text" id="user_turma" name="user_turma" placeholder="Turma" value="{{$user_edit->turma}}">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="user_whatssap">whatsapp:</label>
                      <input class="form-control form-control-sm" type="text" id="user_whatsapp" name="user_whatsapp" placeholder="whatsapp para contato" value="{{$user_edit->whatsapp}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                  <button class="btn btn-primary btn-sm"><i class="fas fa-sync"></i> atualizar</button>
                  </div>
                  <div class="col-md-1">
                  <a class="btn btn-danger btn-sm" href="{{URL::previous()}}"><i class="fas fa-chevron-left"></i> voltar</a>
                  </div>
                 
                </div>
              </form>
              </div>
              <div class="card-footer">
              <div class="row">
                  <div class="alert alert-warning alert-dismissible" style="background-color: transparent; border: none;">
                  </div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
@endsection