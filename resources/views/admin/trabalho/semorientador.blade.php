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
                      <td style="font-size: 15px;">{{$t->titulo}}</td>
                      <td style="font-size: 15px;">{{$t->tema->titulo}}</td>
                      <td>
                          <div class="row">
                            <form action="{{route('trabalho.show')}}" method="POST">
                              {{csrf_field()}}
                              <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                              <button type="submit" style="margin: 0 10px;" class="btn-sm btn btn-button btn-default" title="visualizar trabalho"><i class="fas fa-eye"></i></button>
                            </form>
                          <a style="margin: 0 10px;" href="#" class="btn-sm btn btn-button btn-default" title="Orientar"><i class="fas fa-chalkboard-teacher"></i></a>
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