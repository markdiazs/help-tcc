@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-lock"></i></h3>
              </div>
              <div class="card-body">
              <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>E-mail</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($users) > 0)
                    @foreach($users as $u)
                    <tr>
                      <td>{{$u->name}}</td>
                      <td>{{$u->email}}</td>
                      <td>
                        <form action="{{route('usuario.desblock')}}" method="POST">
                          {{csrf_field()}}
                          <input type="hidden" value="{{$u->id}}" name="user_id">
                          <button type="submit" class="btn-sm btn btn-button btn-default" title="Desbloquear usuário"><i class="fas fa-lock-open"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    @else 
                    <div  style="margin-top: 20px; background-color: #dc3545; color: white; border: none;" class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6 style="font-size: 13px;"><i class="fas fa-info-circle"></i> <b> Não há registros correspondes</b></h6>
                      </div>
                    @endif
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              <!--div class="row">
                  <div class="alert alert-warning alert-dismissible" style="background-color: transparent; border: none;">
                    <h6><i class="icon fas fa-exclamation-triangle"></i>Atenção!</h6>
                    <p>A senha será gerada e enviada para o e-mail informado no cadastro.</p>
                  </div>
              </div>-->
              </div>
              <!-- /.card-body -->
            </div>
@endsection