@include('dashboard.layouts.header')

<body class="hold-transition sidebar-mini layout-fixed">
  @include('sweetalert::alert')
<div class="wrapper">

 @include('dashboard.components.navbar')


@if (Route::current()->getName() == 'dashboard.process.')
  @include('dashboard.components.sidebar', ['categories_id' => $categories_id])  
@endif

@include('dashboard.components.sidebar') 

 @yield('content')


  @include('dashboard.components.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('dashboard.layouts.script')
