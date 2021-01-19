@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="far fa-file-word"></i></h3>
              </div>
              <div class="card-body" style="text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #7e7e80;">
              <h4 style="">{{$trabalho->titulo}}</h4>
              <h6 style="text-align: left;"><strong>Autor:</strong> {{$trabalho->user->name}}</h6>
              <h6 style="text-align: left;"><strong>Orientador:</strong> {{$trabalho->orientador != null?$trabalho->orientador->name: 'Sem orientador'}}</h6>
              <h6 style="text-align: left;"><strong>Descrição:</strong><?php echo $trabalho->descricao; ?></h6>              
              </div>
              <div class="card-footer">
              <div class="row">
                  <a href="{{URL::previous()}}" class="btn btn-sm btn-default"><i class="fas fa-chevron-left"></i> Voltar</a>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
@endsection