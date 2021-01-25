@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="row" style="width: 81%; margin: 0 auto;">
<div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-contract"></i></span>

              <div class="info-box-content">
                <span style="text-transform: uppercase; font-weight: 400;" class="info-box-text">Trabalhos cadastrados</span>
                <span style="font-size: 16px; class="info-box-number">
                  {{$qtdtrabalhos}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-ambulance"></i></span>

              <div class="info-box-content">
                <span style="text-transform: uppercase; font-weight: 400;" class="info-box-text">Trabalhos sem Orientador</span>
                <span style="font-size: 16px;" class="info-box-number">{{$trabalhosalone}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clipboard-list"></i></span>

              <div class="info-box-content">
                <span style="text-transform: uppercase; font-weight: 400;" class="info-box-text">Meus trabalhos</span>
                <span style="font-size: 16px;" class="info-box-number">{{$mytrabalhos}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->





</div>

          <div class="card card-info" style="width: 80%; margin: 0 auto;">
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
                          @can('trabalho-edit')
                          @if($t->user_id == $user->id || $t->orientador_id == $user->id || $p->nome == "Admin")
                          <a style="margin: 0 10px;" href="{{ route('trabalho.edit', $t->id )}} " class="btn-sm btn btn-button btn-default" title="Editar trabalho"><i class="fas fa-edit"></i></a>
                          @endif
                          @endcan

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

                          @can('trabalho-delete')
                          @if($user->id == $t->user_id || $user->id == $t->orientador_id || $p->nome == "Admin")
                          <form action="{{route('trabalho.delete')}}" method="POST">
                            {{ csrf_field()}}
                            <input type="hidden" value="{{$t->id}}" name="trabalho_id">
                            <button style="margin: 0 10px;" type="submit" class="btn-sm btn btn-button btn-default" title="Excluir trabalho"><i class="fas fa-trash"></i></button>
                          </form>
                          @endif
                          @endcan
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
                    <a href="{{route('trabalho.search')}}" title="Ir para página de busca" class="btn btn-default btn-sm "><i class="fas fa-search"></i> pesquisar</a>
              </div>
              <!-- /.card-body -->
            </div>

@endsection