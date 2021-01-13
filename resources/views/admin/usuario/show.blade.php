@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-cogs"></i></h3>
              </div>
              <div class="card-body table-responsive p-0">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user2-160x160.png')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->papeis()->first()->nome}}</p>

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

                <a data-toggle="modal" data-target="#modal-default" href="#" class="btn btn-default btn-block"><i class="fas fa-wrench"></i><b>Alterar Informações</b></a>
              </div>
              </div>
              <div class="card-footer">
              </div>
              <!-- /.card-body -->
            </div>

            <div class="modal fade " id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title"><i class="fas fa-wrench"></i>Alterar Informaçõoes</h6>
            </div>
            <div class="modal-body">
              <form action="{{route('tema.store')}}" method="POST">
              {{csrf_field()}}
                <div class="row">
                    <div class="form-group" style="width: 100%;">
                    <label for="">E-mail: </label>
                        <input class="form-control form-control-sm" type="text" name="tema_title" id="theme-title" placeholder="título">
                    </div>
                    <div class="form-group" style="width: 100%;">
                    <label for="">Whatsapp: </label>
                        <input class="form-control form-control-sm" type="text" name="tema_title" id="theme-title" placeholder="título">
                    </div>
                    <div class="form-group" style="width: 100%;">
                      <label for="">Senha Atual:</label>
                        <input class="form-control form-control-sm" type="password" name="old_password" id="theme-title" placeholder="título">
                    </div>
                    <div class="form-group" style="width: 100%;">
                      <label for="">Nova Senha:</label>
                        <input class="form-control form-control-sm" type="password" name="new_password" id="theme-title" placeholder="título">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-sm btn-default">Salvar</button>
                    </div>
                    <div class="col-2">
                        <button data-dismiss="modal"  class="btn btn-default btn-sm">Voltar</button>
                    </div>

                </div>
                <div class="row">
                  <div class="alert alert-warning alert-dismissible" style="background-color: transparent; border: none;">
                    <h6><i class="icon fas fa-exclamation-triangle"></i>Atenção!</h6>
                    <p>prencha apenas os campos no qual você quer alterar.</p>
                  </div>
              </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endsection