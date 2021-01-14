@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users-cog"></i></h3>
              </div>
              <div class="card-body">
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                <ul style="font-size: 13px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
              @endif

              <form action="{{route('usuario.updatemyperfil')}}" method="POST">
              {{csrf_field()}}
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Nome:</label>
                        <input type="text" class="form-control form-control-sm" name="user_name" value="{{$user->name}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">E-mail:</label>
                        <input type="email" class="form-control form-control-sm" name="user_email" value="{{$user->email}}">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Pefil:</label>
                        <input type="text" disabled class="form-control form-control-sm" name="user_perfil" value="{{$user->papeis()->first()->nome}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Whatsapp:</label>
                        <input type="text" class="form-control form-control-sm" name="user_whatsapp" value="{{$user->whatsapp}}" placeholder="{{$user->whatsapp != null? '': 'whatsapp não cadastrado'}}">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Nova senha:</label>
                        <input type="password" class="form-control form-control-sm" name="new_password">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Digite a senha novamente por favor:</label>
                        <input type="password" class="form-control form-control-sm" name="confirm_password">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for=""><i class="fas fa-exclamation-triangle"></i> Digite a sua senha atual para confirmar as suas alterações:</label>
                        <input type="password" name="user_password" id="user_password" class="form-control form-control-sm">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-sm">Salvar</button>
                    <a href="#" class="btn btn-default btn-sm">Voltar</a>
                </div>
              </div>
              </form>
              </div>
              <!-- /.card-body -->

            </div>
@endsection