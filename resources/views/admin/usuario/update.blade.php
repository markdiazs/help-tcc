@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users-cog"></i></h3>
              </div>
              <div class="card-body">
              <form action="{{route('usuario.updatemyperfil')}}" method="POST">
              {{csrf_field()}}
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">*Nome: 
                            @error('user_name')
                                <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="text" class="form-control form-control-sm" name="user_name" value="{{Request::old('user_name')!=null?Request::old('user_name'):$user->name}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">*E-mail:
                            @error('user_email')
                                <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="email" class="form-control form-control-sm" name="user_email" value="{{Request::old('user_email')!=null?Request::old('user_email'):$user->email}}">
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
                        <input type="text" class="form-control form-control-sm" name="user_whatsapp" value="{{$user->whatsapp}}" value="{{Request::old('user_whatsapp')!=null?Request::old('user_whatsapp'):$user->whatsapp}}">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Nova senha:
                            @error('new_password')
                                <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="password" class="form-control form-control-sm" name="new_password">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Digite a senha novamente por favor:
                            @error('confirm_password')
                                <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="password" class="form-control form-control-sm" name="confirm_password">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for=""><i class="fas fa-exclamation-triangle"></i>*Digite a sua senha atual para confirmar as suas alterações: 
                            @error('user_password')
                                <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="password" name="user_password" id="user_password" class="form-control form-control-sm">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <button style="background: #434B66;color: white;" type="submit" class="btn btn-default btn-sm"><i class="fas fa-sync"></i>Atualizar</button>
                    <a style="background: #434B66;color: white;" href="{{route('usuario.perfil')}}" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i>Voltar</a>
                </div>
              </div>
              </form>
              </div>
              <!-- /.card-body -->

            </div>
@endsection