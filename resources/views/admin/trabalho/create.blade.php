@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-word"></i></h3>
              </div>
              <div class="card-body">
              <form action="{{route('trabalho.store')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="user_name">*Título:
                        @error('titulo')
                          <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                        @enderror
                      </label>

                      <input class="form-control form-control-sm" type="text" id="titulo" name="titulo" placeholder="" value="{{ Request::old('titulo') }}">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="row">
                    <div class="form-group col-md-8">
                      <label for="user_email">*Tema:</label>
                      @error('tema_id')
                          <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                      @enderror
                      <select class="form-control form-control-sm" name="tema_id" id="tema_id">
                        @foreach($temas as $t)
                        @if(isset($tema) || Request::old('tema_id') == $t->id)
                        <option selected value="{{$t->id}}">{{$t->titulo}}</option>
                        @else
                        <option value="{{$t->id}}">{{$t->titulo}}</option>
                        @endif
                  
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                    <label for="user_email">*Novo tema:</label>
                    <button style="background: #434B66;color: white;" type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-sm btn-default"><i class="fas fa-plus"></i> novo tema</button>
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
                        @foreach($professores as $p)  
                        @if(Request::old('orientador_id') == $p->id)
                          <option selected value="{{$p->id}}">Prof° {{$p->name}}</option>
                        @else 
                          <option value="{{$p->id}}">Prof° {{$p->name}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  @if(isset($alunos))
                  <div class="col-4">
                    <div class="form-group">
                      <label for="user_name">*Aluno:
                        @error('aluno_id')
                          <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                        @enderror
                      </label>

                      <select class="form-control form-control-sm" name="aluno_id" id="aluno_id">
                        <option selected value=""></option>
                        @foreach($alunos as $a)  
                        @if(Request::old('aluno_id') == $a->id)
                          <option selected value="{{$a->id}}">{{$a->name}} | {{$a->turma}}</option>
                        @else 
                          <option value="{{$a->id}}">{{$a->name}} | {{$a->turma}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  @endif
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="theme-description">*Descrição do trabalho:
                          @error('descricao')
                          <span style="color: red; font-size: 10px;" class="error">{{ $message }}</span>
                          @enderror
                        </label>
                        <textarea style="width: 100%;" name="descricao" class="textarea form-control" rows="5" cols="700" placeholder="Descreva o seu projeto...">{{Request::old('descricao')}}</textarea>
                        <script> CKEDITOR.replace( 'descricao', {width: 1230 }); </script>
                        
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-1">
                  <button style="background: #434B66;color: white;" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Cadastrar</button>
                  </div>
                  <div class="col-md-1">
                  <a style="background: #434B66;color: white;" class="btn btn-default btn-sm" href="{{URL::previous()}}"><i class="fas fa-chevron-left"></i> Voltar</a>
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

            <div class="modal fade " id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title"><i class="fas fa-plus"></i> Cadastrar Tema</h6>
            </div>
            <div class="modal-body">
              <form id="cadtheme" action="{{route('tema.store')}}" method="POST">
              {{csrf_field()}}
                <div class="row">
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control form-control-sm" type="text" name="tema_title" id="theme-title" placeholder="título">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <button style="background: #434B66;color: white;" id="savethemebtn" type="submit" class="btn btn-sm btn-default"><i class="fas fa-plus"></i>Salvar</button>
                    </div>
                    <div class="col-2">
                        <button style="background: #434B66;color: white;" id="closemodal" data-dismiss="modal"  class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i> Voltar</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <script>
      $("#cadtheme").submit(function(event){
        event.preventDefault();
        if (event.keyCode == 13) {               
          event.preventDefault();
          return false;
         }

        $.ajax({
          url: "{{route('tema.store')}}",
          type: "POST",
          data: $("#cadtheme").serialize(),
          success: function(result){
            $("#closemodal").trigger('click');
            $("#tema_id").prepend("<option selected value="+ result[0] +">"+ result[1] + "</option>")
          }
        });
      });
      </script>
@endsection