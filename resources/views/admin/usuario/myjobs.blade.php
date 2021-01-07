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
                            <form action="{{route('usuario.editmyjob')}}" method="POST">
                          {{csrf_field()}}
                          <input type="hidden" name="trabalho_id" value="{{$t->id}}">
                          <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Editar trabalho"><i class="fas fa-edit"></i></button>
                          </form>
                          <form action="{{route('trabalho.delete')}}" method="POST">
                            {{ csrf_field()}}
                            <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                            <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-danger" title="Excluir trabalho"><i class="fas fa-trash"></i></button>
                          </form>
                          </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              </div>
              <!-- /.card-body -->
            </div>
@endsection