@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-shield"></i></h3>
              </div>
              <div class="card-body">
                <div class="row" style="width: 100%;">
                @foreach($papeis as $p)
                <div class="col-md-4">
                        <div style="background-color:#D64A65 !important;" class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-user"></i></span>

                        <div class="info-box-content">
                            <span style="font-weight: bold; text-transform: uppercase;padding-top: 10px;" class="info-box-text">{{$p->nome}}</span>
                            <span class="info-box-number"><a style="color: white; text-transform: uppercase; padding-left: 10px; font-size: 13px;" class="" href="{{route('papel.permissao',$p->id)}}"><i style="padding-right: 7px;" class="fas fa-shield-alt"></i>Permissoes</a></span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    @endforeach

                </div>
                <div class="row">
                <div class="card" style="width: 100%;">
              <div class="card-header">
                <h3 class="card-title">Permissões para {{$papel->nome}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Descrição</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if(count($papel->permissoes) != 0)
                      @foreach($papel->permissoes as $p)
                    <tr>
                      <td>{{$p->nome}}</td>
                      <td>{{$p->descricao}}</td>
                      <td>
                          <form action="{{route('papel.permissao.remove')}}" method="POST">
									            {{ csrf_field() }}
                              <input type="hidden" value="{{$papel->id}}" name="papel_id" id="papel_id">
                              <input type="hidden" value="{{$p->id}}" name="permissao_id" id="permissao_id">
                              <button type="submit" class="btn btn-default btn-sm"><i style="padding-right: 10px;" class="fas fa-trash"></i>remover</button>
                          </form>
                          
                    </tr>
                      @endforeach
                      @else 
                     <tr>
                         <td rowspan="2"><h6>Não possui permissões cadastradas</h6></td>
                     </tr>
                      @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                </div>
                
              </div>
              <div class="card-footer">
                <form action="{{route('papel.permissao.store')}}" method="POST">
                {{csrf_field()}}
                    <input type="hidden" value="{{$papel->id}}" name="papel_id" id="papel_id">
                <div class="form-group">
                <label class="col-md-2">Nova Permissão</label>
                @if(isset($permissao))  
                <select style="width: 400px;" class="form col-md-6" name="permissao_id" id="permissao_id">
                  @foreach($permissao as $p)
                      <option value="{{$p->id}}">{{$p->descricao}}</option>
                  @endforeach
                </select>
                @endif
                <button type="submit" style="float: right;" class="btn btn-sm btn-default"><i class="fas fa-lock-open"></i> Desbloquear Permissão</button>
                </div>
                </form>

              </div>
              <!-- /.card-body -->
            </div>
@endsection