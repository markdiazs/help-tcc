@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-id-card-alt"></i></h3>
              </div>
              <div class="card-body table-responsive p-0">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user2-160x160.png')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->papeis()->first()->nome}}(a)</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Trabalhos</b> <a href="{{route('usuario.myjobs')}}" class="float-right">{{$trabalhos}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>E-mail</b> {{$user->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Whatsapp</b> {{$user->whatsapp != null?$user->whatsapp:'Não Informado'}}</a>
                  </li>
                </ul>

                <a style="background: #434B66;color: white;"  class="btn btn-default btn-sm" href="{{route('usuario.editmyperfil')}}"  name="btn_alter_info" id="btn_alter_info"><i class="fas fa-wrench"></i><b>Alterar Informações</b></a>
                <a style="background: #434B66;color: white;" href="/" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i><b>Voltar</b></a>
              </div>
              </div>
              <div class="card-footer">
              </div>
              <!-- /.card-body -->
            </div>
@endsection