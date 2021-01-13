@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-search"></i></h3>
              </div>
              <div class="card-body">
              <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Perfil</th>
                      <th>Whatssapp</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($users) > 0)

                    @foreach($users as $u)
                    <tr>
                      <td>{{$u->name}}</td>
                      <td>{{$u->email}}</td>
                      <td>
                        @foreach($u->papeis()->get() as $papel)
                        {{$papel->nome}}
                        @endforeach
                      </td>
                      <td>{{$u->whatsapp}}</td>
                      <td>
                          <div class="row">
                          @can('usuario-edit')
                          <form action="{{route('usuario.edit')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$u->id}}" name="user_id">
                          <button type="submit" style="margin: 0 10px;"  class="btn-sm btn btn-button btn-default" title="Editar usuário"><i class="fas fa-edit"></i></button>
                          </form>
                          @endcan
                          @can('usuario-block')
                          @if($u->status == 1)
                          <form action="{{route('usuario.blocked')}}" method="POST">
                          {{ csrf_field() }}
                            <input type="hidden" value="{{$u->id}}" name="user_id" id="user_id">
                          <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Bloquear usuário"><i class="fas fa-lock"></i></button>
                          </form>
                          
                          @else 
                          <form action="{{route('usuario.desblock')}}" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" value="{{$u->id}}" name="user_id" id="user_id">
                          <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Desbloquear usuário"><i class="fas fa-lock-open"></i></button>
                          </form>
                          @endif
                          @endcan
                          @can('usuario-delete')
                          <form action="{{route('usuario.delete')}}" method="POST">
                            {{ csrf_field()}}
                            <input type="hidden" value="{{$u->id}}" name="user_id">
                            <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Excluir usuário"><i class="fas fa-trash"></i></button>

                          </form>
                          @endcan
                     
                          </div>
                          
                      </td>
                      
                    </tr>
                    @endforeach
                    @else 
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h6><i class="fas fa-info-circle"></i> <b> Não há registros correspondes aos filtros selecionados </b></h6>
                    </div>
                    @endif
                  </tbody>
                  
                </table>
                @if(isset($filters))
                {!! $users->appends(Request::all())->links() !!}
                @else 
                {!! $users->links() !!}
                @endif
              </div>
              <div class="card-footer">
              <form action="{{route('usuario.search')}}" method="GET">
                {{csrf_field()}}
                        <div class="form-group">
                            <label for="search"><i class="fas fa-filter"></i> Filtrar:</label>
                        </div>
                        <div class="row" style="width: 100%;">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="job-title">Nome:</label>
                                    <input type="text" class="form-control form-control-sm" @if(isset($filters['name'])) value="{{$filters['name']}}" @endif name="user_nome" placeholder="buscar por título" />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="user_papel">Pefil:</label>
                                    <select class="form-control form-control-sm" name="user_papel" id="">
                                        <option selected value=""></option>
                                        @foreach($papeis as $papel)
                                        <option @if(isset($filters['papel_id']) && $filters['papel_id'] == $papel->id) selected @endif value="{{$papel->id}}">{{$papel->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="job-title">E-mail:</label>
                                    <input class="form-control form-control-sm" @if(isset($filters['email'])) value="{{$filters['email']}}" @endif type="email" name="user_email" id="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-default"><i class="fas fa-search"></i> Buscar</button>
                                <a href="{{route('usuario.index')}}" class="btn btn-sm btn-default"><i class="fas fa-filter"></i> Limpar filtros</a>
                            </div>
                        </div>
                    </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection