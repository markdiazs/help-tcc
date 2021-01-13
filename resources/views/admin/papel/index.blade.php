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
                        <div style="background-color: #D64A65 !important;" class="info-box bg-info">
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
                <h3 class="card-title">Permissões para ?????</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Descrição</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>selecione um papel</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                </div>
                
              </div>
              <div class="card-footer">
              <div class="form-group">
                <label class="col-md-2">Nova Permissão</label>
                <select style="width: 400px;" class="form col-md-6" name="permissao" id="">
                </select>
                <a style="float: right;" href="#" class="btn btn-sm btn-default"><i class="fas fa-lock-open"></i> Desbloquear Permissão</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
@endsection