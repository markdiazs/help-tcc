@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-word"></i></h3>
              </div>
              <div class="card-body">
              <form action="{{route('trabalho.update')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" value="{{$trabalho->id}}" name="trabalho_id">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="user_name">Título:</label>
                      <input class="form-control form-control-sm" type="text" id="titulo" name="titulo" placeholder="" value="{{$trabalho->titulo}}">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="row">
                    <div class="form-group col-md-8">
                      <label for="user_email">Tema:</label>
                      <select class="form-control form-control-sm" name="tema_id" id="tema_id">
                        @foreach($temas as $t)
                        @if($trabalho->tema->id == $t->id)
                        <option selected value="{{$t->id}}">{{$t->titulo}}</option>
                        @else
                        <option value="{{$t->id}}">{{$t->titulo}}</option>
                        @endif
                  
                        @endforeach
                      </select>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="user_name">Orientador:</label><span class="float-right badge bg-primary">Deixe em branco se for o caso</span>
                      <select class="form-control form-control-sm" name="orientador_id" id="orientador_id">
                        <option selected value=""></option>
                        @foreach($orientadores as $p)
                        @if(isset($trabalho->orientador) && $trabalho->orientador->id == $p->id) 
                        <option selected value="{{$p->id}}">Prof° {{$p->name}}</option>
                        @else 
                        <option value="{{$p->id}}">Prof° {{$p->name}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="theme-description">Descrição do trabalho:</label>
                        <textarea name="descricao" class="textarea form-control" rows="5" cols="400" placeholder="Descreva o seu projeto...">{{$trabalho->descricao}}</textarea>
                        <script> CKEDITOR.replace( 'descricao', {width: 1230 }); </script>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-sync"></i> atualizar</button>
                  </div>
                  <div class="col-md-1">
                  <a class="btn btn-danger btn-sm" href="{{URL::previous()}}"><i class="fas fa-chevron-left"></i> voltar</a>
                  </div>
                 
                </div>
              </form>
              </div>
              <div class="card-footer">
              <div class="row">
                  <div class="alert alert-warning alert-dismissible" style="background-color: transparent; border: none;">
                    <h6><i class="icon fas fa-exclamation-triangle"></i>Atenção!</h6>
                    <p>Os trabalhos sem um orientador estarão disponíveis para que os professores possam analisar a proposta e eventualmente orientar o projeto</p>
                  </div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
@endsection