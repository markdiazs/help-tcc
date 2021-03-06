@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus"></i></h3>
              </div>
              <div class="card-body">
              <form action="{{route('usuario.store')}}" method="POST">
              {{ csrf_field() }}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="user_name">* Nome Completo:
                        @error('user_name')
                          <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                        @enderror
                      </label>
                      <input class="form-control form-control-sm" type="text" id="user_name" name="user_name" placeholder="nome completo" value="{{ Request::old('user_name') }}">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="user_email">* E-mail:
                        @error('user_email')
                          <span style="color: red;font-size: 10px;" class="error">{{ $message }}</span>
                        @enderror
                      </label>
                      <input class="form-control form-control-sm" type="email" id="user_email" name="user_email" placeholder="email para contato">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="user_name">Tipo de perfil:</label>
                      <select class="form-control form-control-sm" name="user_papel" id="user_papel" name="user_papel">
                        @foreach($papeis as $p)
                        @if(Request::old('user_papel')  == $p->id)
                          <option selected value="{{$p->id}}">{{$p->nome}}</option>
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
                      <input class="form-control form-control-sm" type="text" id="user_codigo" name="user_codigo" placeholder="Matricula/Código" value="{{ Request::old('user_codigo') }}">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="user_email">Turma:</label>
                      <input class="form-control form-control-sm" type="text" id="user_turma" name="user_turma" placeholder="Turma" value="{{ Request::old('user_turma') }}" >
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="user_whatssap">whatsapp:</label>
                      <input class="form-control form-control-sm" type="text" id="user_whatsapp" name="user_whatsapp" id="user_whatsapp" placeholder="whatsapp para contato" value="{{ Request::old('user_whatsapp') }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                  <button style="background: #434B66;color: white;" type="submit" class="btn btn-default btn-sm"><i class="fas fa-plus"></i>cadastrar</button>
                  </div>
                  <div class="col-md-1">
                  <a style="background: #434B66;color: white;" class="btn btn-default btn-sm" href="{{URL::previous()}}"><i class="fas fa-chevron-left"></i> voltar</a>
                  </div>
                 
                </div>
              </form>
              </div>
              <div class="card-footer">
              <div class="row">
                  <div class="alert alert-warning alert-dismissible" style="background-color: transparent; border: none;">
                    <h6><i class="icon fas fa-exclamation-triangle"></i>Atenção!</h6>
                    <p>A senha será gerada e enviada para o e-mail informado no cadastro.</p>
                  </div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>

@endsection