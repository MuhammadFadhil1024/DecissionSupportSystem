@extends('dashboard.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            {{-- <h1 class="m-0">Category</h1> --}}
            {{-- <td> --}}
              <a type="button" href="/dashboard/process/category/data/{{ $categories_id }}/generate" class="btn btn-block btn-outline-primary"> <i class="nav-icon fas fa-sync"></i>  Generate</a>
            {{-- </td> --}}
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Detail</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="normalization" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="dt-head-center" style="width: 15px">Id</th>
                            <th class="dt-head-center">Name</th>
                            <th class="dt-head-center" style="width: 15px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($alternatives as $index => $alternative)
                            <tr>
                              <td>{{ $alternative->alternative_code }}</td>
                              <td>{{ $alternative->name }}</td>
                              <td class="dt-body-center">
                                <a href="/dashboard/process/category/data/{{ $categories_id }}/result/detail/{{ $alternative->id }}/alternative" class="badge badge-info"><span class="p-2"> Detail </span></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Result</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="result" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="dt-head-center" style="width: 10px">Rank</th>
                            <th class="dt-head-center" style="width: 15px">Id</th>
                            <th class="dt-head-center">Name</th>
                            <th class="dt-head-center">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $index => $result)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $result->alternative_code }}</td>
                                <td>{{ $result->name }}</td>
                                <td>{{ $result->result }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@push('js')
<script src="{{ asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/dashboard//plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
      $("#normalization").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<script>
    $(function () {
      $("#result").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <script>
     $(document).ready(function() {
                $(document).on('click', '.showbtn', function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: 'category/' + id,
                        success: function(response) {
                            $('.name').text(response.categorydata.name);
                            $('.description').text(response.categorydata.description);
                        }
                    })
                })
            })
  </script>
@endpush
