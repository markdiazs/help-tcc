@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="card card-info" style="width: 80%; margin: 0 auto;">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-lock"></i></h3>
              </div>
              <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Tema</th>
                      <th>Autor</th>
                      <th>E-mail</th>
                      <th>Whatsapp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="font-size: 12px;">Criação de portais corporativos com DRUPAL</td>
                      <td style="font-size: 12px;">CMS (Gerenciador de conteúdo Drupal)</td>
                      <td style="font-size: 12px;">Marcelo Taz</td>
                      <td>contato@gmail.com</td>
                      <td>985398567</td>
                      <td>
                          <div class="row">
                          <a style="margin: 0 10px;" href="#" class="btn-sm btn btn-button btn-default" title="Visualizar trabalho"><i class="fas fa-eye"></i> +detalhes </a>
                          <a style="margin: 0 10px;" href="#" class="btn-sm btn btn-button btn-default" title="Visualizar trabalho"><i class="fas fa-lock-open"></i> aprovar</a>
                          <a style="margin: 0 10px;" href="#" class="btn-sm btn btn-button btn-default" title="Visualizar trabalho"><i class="fas fa-trash"></i> Desqualificar </a>
                          </div>
                          
                      </td>
                      
                    </tr>
                    <tr>
                      <td style="font-size: 12px;">Criação de portais corporativos com DRUPAL</td>
                      <td style="font-size: 12px;">CMS (Gerenciador de conteúdo Drupal)</td>
                      <td style="font-size: 12px;">Marcelo Taz</td>
                      <td>contato@gmail.com</td>
                      <td>985398567</td>
                      <td>
                          <div class="row">
                          <a style="margin: 0 10px;" href="#" class="btn-sm btn btn-button btn-default" title="Visualizar trabalho"><i class="fas fa-eye"></i> +detalhes </a>
                          <a style="margin: 0 10px;" href="#" class="btn-sm btn btn-button btn-default" title="Visualizar trabalho"><i class="fas fa-lock-open"></i> aprovar</a>
                          <a style="margin: 0 10px;" href="#" class="btn-sm btn btn-button btn-default" title="Visualizar trabalho"><i class="fas fa-trash"></i> Desqualificar </a>
                          </div>
                          
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              </div>
              <!-- /.card-body -->
            </div>
@endsection