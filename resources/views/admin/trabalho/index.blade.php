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
                          
                          
                          <form action="{{route('trabalho.edit')}}" method="POST">
                          {{csrf_field()}}
                          <input type="hidden" name="trabalho_id" value="{{$t->id}}">
                          <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Editar trabalho"><i class="fas fa-edit"></i></button>
                          </form>
                          @if(!isset($t->orientador))
                          <form action="{{route('usuario.orientar')}}" method="POST">
                          {{csrf_field()}}
                          <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                          <input type="hidden" value="{{$t->user->id}}" name="autor_id">
                          <button type="submit" style="margin: 0 10px;" class="btn-sm btn btn-button btn-default" title="Orientar"><i class="fas fa-chalkboard-teacher"></i></button>
                          </form>
                          @endif
                          <form action="{{route('trabalho.delete')}}" method="POST">
                            {{ csrf_field()}}
                            <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                            <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-danger" title="Excluir trabalho"><i class="fas fa-trash"></i></button>
                          </form>
                          </div>
                          
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <h1>Não possui trabalhos cadastrados</h1>
                    @endif
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                    <form action="">
                        <div class="form-group">
                            <label for="search"><i class="fas fa-filter"></i> Filtrar:</label>
                        </div>
                        <div class="row" style="width: 100%;">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="job-title">título:</label>
                                    <input type="text" class="form-control form-control-sm" name="job-title" name="job-title" placeholder="buscar por título" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="job-title">Tema:</label>
                                    <select class="form-control form-control-sm" name="" id="">
                                        <option selected value=""></option>
                                        <option value="">banco de dados</option>
                                        <option value="">banco de dados</option>
                                        <option value="">banco de dados</option>
                                        <option value="">banco de dados</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="job-title">Orientador:</label>
                                    <select class="form-control form-control-sm" name="" id="">
                                    <option selected value=""></option>
                                    <option value="">Prof° Marcio Veraz</option>
                                    <option value="">Prof° Marcio Veraz</option>
                                    <option value="">Prof° Marcio Veraz</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-default"><i class="fas fa-search"></i> Buscar</button>
                                <a href="#" class="btn btn-sm btn-default"><i class="fas fa-filter"></i> Limpar filtros</a>
                            </div>
                        </div>
                    </form>
              </div>
              <!-- /.card-body -->
            </div>
@endsection