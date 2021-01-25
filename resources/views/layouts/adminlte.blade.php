<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token()}}">
  <title>Help Tcc</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
  @toastr_css

  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.map"></script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a style="color: #D64A65; font-weight: bold;" class="nav-link"  href="#" role="button">Chat <i style="font-size: 23px;" class="far fa-comment-alt"></i><span class="right badge badge-danger">Em breve</span></a>
      </li>
    </ul>
    

    <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
    <a title="ajuda" href="#" class="nav-link"><i class="fas fa-info-circle"></i></a>
          </li>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" id="btn_notify">
          <i class="far fa-bell"></i>
          <span id="countnotify" class="badge badge-warning navbar-badge">{{count($user->unreadNotifications)}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header">{{count($user->unreadNotifications)}} Notificações</span>
          @foreach($user->notifications as $not)
          <div class="dropdown-divider"></div>
          <a style="font-size: 12px;font-weight: bold;" href="#" class="dropdown-item">
          <i class="fas fa-flag"></i>{{$not->data['message']}}
            <span class="float-right text-muted text-sm">{{$not->created_at->locale('pt')->diffForHumans()}}</span>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
      </li>
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <!--<img src="{{asset('dist/img/user2-160x160.png')}}" class="user-image img-circle elevation-2" alt="User Image"> -->
          <span class="d-none d-md-inline">{{$user->name}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->
          <li style="background-color: #D64A65 !important;" class="user-header bg-primary">
            <img src="{{asset('dist/img/user2-160x160.png')}}" class="img-circle elevation-2" alt="User Image">

            <p>
              {{$user->name}}
              <small>Membro desde {{$user->created_at->locale('pt')->isoFormat('MMMM Do YYYY')}}</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li  class="user-body">
            <div class="row">
              <!-- <div class="col-6 text-center">
                <a href="#">editar perfil</a>
              </div> -->
              <div class="col-12 text-justify">
                <a class="btn btn-default btn-sm" style="float: right;" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                sair
              </a>
                <a class="btn btn-default btn-sm" href="{{route('usuario.perfil')}}"  style="float: left; border: none;">Perfil</a>
              </a>  

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
                </form>
              </div>
            </div>
            <!-- /.row -->
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside style="background-color: #434B66;" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('dist/img/help_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Help TCC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar ">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu tree" data-widget="treeview" role="menu" data-accordion="false">
           
           @can('usuario-view')
            <li class=" nav-item has-treeview">
                <a href="#" class="nav-link">
                <i style="font-weight: bold;" class="fas fa-users"> | </i>
                <span style="font-weight: 500; text-transform: uppercase;">Usuários</span>
                <span class="pull-right-container">
                <i style="float: right;" class="fas fa-sort-down"></i>
                </span>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item"><a style="text-transform: uppercase; font-weight: 500; font-size: 14px;" class="nav-link" href="{{route('usuario.index')}}"><i class="fas fa-search"></i> </i>buscar usuário</a></li>
                  <li class="nav-item"><a style="text-transform: uppercase; font-weight: 500; font-size: 14px;" class="nav-link" href="{{route('usuario.create')}}"><i style="font-weight: bold; margin-right: 7px;" class="fas fa-plus-square"> </i>novo usuário</a></li>
                 @can('papel-edit')
                  <li class="nav-item"><a style="text-transform: uppercase; font-weight: 500; font-size: 14px;" class="nav-link" href="{{route('papel.index')}}"><i style="font-weight: bold; margin-right: 7px;" class="fas fa-shield-alt"> </i>papéis</a></li>
                @endcan
                  <li class="nav-item"><a style="text-transform: uppercase; font-weight: 500; font-size: 14px;" class="nav-link" href="{{route('usuario.block')}}"><i style="font-weight: bold; margin-right: 7px;" class="fas fa-lock"></i>Usuários Bloqueados</a></li>
                </ul>
            </li>
           @endcan
           
            <li class=" nav-item has-treeview">
                <a href="#" class="nav-link">
                <i style="font-weight: bold;" class="fas fa-thumbtack"> | </i>
                <span style="font-weight: 500; text-transform: uppercase;">Trabalhos</span>
                <span class="pull-right-container">
                <i style="float: right;" class="fas fa-sort-down"></i>
                </span>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('trabalho-search')
                  <li class="nav-item"><a style="text-transform: uppercase; font-weight: 500; font-size: 14px;" class="nav-link" href="{{route('trabalho.index')}}"><i class="fas fa-search"></i> </i>buscar trabalho</a></li>
                  @endcan
                  <li class="nav-item"><a style="text-transform: uppercase; font-weight: 500; font-size: 14px;" class="nav-link" href="{{route('trabalho.create')}}"><i style="font-weight: bold; margin-right: 7px;" class="fas fa-plus-square"> </i>novo trabalho</a></li>
                  <li class="nav-item"><a style="text-transform: uppercase; font-weight: 500; font-size: 14px;" class="nav-link" href="{{route('usuario.myjobs')}}"><i style="font-weight: bold; margin-right: 7px;" class="fas fa-tasks"></i>Meus trabalhos</a></li>
                  
                </ul>
            </li>
            <li class="nav-item">
                <a  class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div style="text-align: center; width: 90%; margin: 0 auto;" >
        @include('flash::message')
        </div>
        
        <div class="row">
            @hasSection ('body')
                @yield('body')
            @endif
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <p>Tema adaptado por Marcos Dias</p>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('dist/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$("#btn_notify").click(function(e){
  $.ajax({
    url: "{{route('notify.readall')}}",
    type: "GET",
    data:{_token: "{{ csrf_token() }}"},
    success: function(result){

        $("#countnotify").html("0");
    },
    error: function(e){
      console.log(e);
    }
  });
});

</script>
  @jquery
  @toastr_js
  @toastr_render
</body>
</html>
