@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-search"></i></h3>
              </div>
              <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Tema</th>
                      <th>Autor</th>
                      <th>Orientador</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if(count($trabalhos) > 0)
                      @foreach($trabalhos as $t)
                    <tr>
                      <td style="font-size: 15px;">{{$t->titulo}}</td>
                      <td style="font-size: 15px;">{{$t->tema->titulo}}</td>
                      <td style="font-size: 15px;">{{$t->user->name}}</td>
                      <td style="font-size: 15px;">
                        @if($t->orientador != null)
                            Prof° {{$t->orientador->name}}
                        @else 
                            <i class="far fa-frown"></i> Sem orientador
                        @endif
                      </td>
                      <td>
                          <div class="row">
                          <form action="{{route('trabalho.show')}}" method="POST">
                              {{csrf_field()}}
                              <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                              <button type="submit" style="margin: 0 10px;" class="btn-sm btn btn-button btn-default" title="visualizar trabalho"><i class="fas fa-eye"></i></button>
                            </form>
                          
                          <a style="margin: 0 10px;" href="{{route('trabalho.edit',$t->id)}}" class="btn-sm btn btn-button btn-default" title="Editar trabalho"><i class="fas fa-edit"></i></a>
                  
                          @if(!isset($t->orientador))
                          @can('usuario-orientar')
                          <form action="{{route('usuario.orientar')}}" method="POST">
                          {{csrf_field()}}
                          <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                          <input type="hidden" value="{{$t->user->id}}" name="autor_id">
                          <button type="submit" style="margin: 0 10px;" class="btn-sm btn btn-button btn-default" title="Orientar"><i class="fas fa-chalkboard-teacher"></i></button>
                          </form>
                          @endcan
                          @endif
                          <form action="{{route('trabalho.delete')}}" method="POST">
                            {{ csrf_field()}}
                            <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                            <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Excluir trabalho"><i class="fas fa-trash"></i></button>
                          </form>
                          </div>
                          
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
                @if(isset($filters))
                {!! $trabalhos->appends(Request::all())->links() !!}
                @else 
                {!! $trabalhos->links() !!}
                @endif
              </div>
              <div class="card-footer">
                    <form action="{{route('trabalho.search')}}" method="GET">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="search"><i class="fas fa-filter"></i> Filtrar:</label>
                        </div>
                        <div class="row" style="width: 100%;">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="job-title">título:</label>
                                    <input type="text" class="form-control form-control-sm" name="titulo_trabalho" placeholder="buscar por título" @if(isset($filters['titulo'])) value="{{$filters['titulo']}}" @endif>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="job-title">Tema:</label>
                                    <select class="form-control form-control-sm" name="tema_id" id="">
                                    <option selected value=""></option>
                                        @foreach($temas as $t)
                                        @if(isset($filters['tema_id']) && $filters['tema_id'] == $t->id)
                                        <option selected value="{{$t->id}}">{{$t->titulo}}</option>
                                        @else 
                                        <option value="{{$t->id}}">{{$t->titulo}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="job-title">Orientador:</label>
                                    <select class="form-control form-control-sm" name="orientador_id" id="">
                                    <option selected value=""></option>
                                    @foreach($orientadores as $o)
                                    @if(isset($filters['orientador_id']) && $filters['orientador_id'] == $o->id)
                                    <option selected value="{{$o->id}}">Prof° {{$o->name}}</option>
                                    @else 
                                    <option value="{{$o->id}}">Prof° {{$o->name}}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button style="background: #434B66;color: white;" type="submit" class="btn btn-sm btn-default"><i class="fas fa-search"></i> Buscar</button>
                                <a style="background: #434B66;color: white;" href="{{route('trabalho.index')}}" class="btn btn-sm btn-default"><i class="fas fa-filter"></i> Limpar filtros</a>
                            </div>
                        </div>
                    </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection