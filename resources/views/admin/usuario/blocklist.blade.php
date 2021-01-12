@extends('layouts.adminlte',["current" => "Início"])

@section('body')
<div class="error-page">
        <h2 class="headline text-danger">500</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Seu perfil se encontra bloqueado no sistema</h3>

          <p>
            <a href="/">retorne ao ínicio</a>.
          </p>
        </div>
      </div>
@endsection