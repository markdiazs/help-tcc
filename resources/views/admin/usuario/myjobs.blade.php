@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tasks"></i></h3>
              </div>
              <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Tema</th>
                    </tr>
                  </thead>
                  @if(count($trabalhos) > 0)
                  <tbody>
                    @foreach($trabalhos as $t)
                    <tr>
                      <td>{{$t->titulo}}</td>
                      <td>{{$t->tema->titulo}}</td>
                      <td>
                          <div class="row">
                            <form action="{{route('trabalho.show')}}" method="POST">
                              {{csrf_field()}}
                              <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                              <button type="submit" style="margin: 0 10px;" class="btn-sm btn btn-button btn-default" title="visualizar trabalho"><i class="fas fa-eye"></i></button>
                            </form>

                          <a style="margin: 0 10px;" href="{{ route('usuario.editmyjob',$t->id) }}" class="btn-sm btn btn-button btn-default" title="Editar trabalho"><i class="fas fa-edit"></i></a>
      
                          <form action="{{route('trabalho.delete')}}" method="POST">
                            {{ csrf_field()}}
                            <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                            <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Excluir trabalho"><i class="fas fa-trash"></i></button>
                          </form>
                          </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  @else
                  <div  style="margin-top: 20px; background-color: #dc3545; color: white; border: none;" class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6 style="font-size: 13px;"><i class="fas fa-info-circle"></i> <b> Não há registros correspondes</b></h6>
                  </div>
                  @endif
                </table>
              </div>
              <div class="card-footer">
              </div>
              <!-- /.card-body -->
            </div>
@endsection