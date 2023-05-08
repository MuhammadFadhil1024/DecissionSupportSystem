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
          <div class="col-sm-6">
            {{-- <h1 class="m-0">Category</h1> --}}
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="dt-head-center">No</th>
                            <th class="w-50 dt-head-center">Category</th>
                            <th class="w-50 dt-head-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                            <tr>
                              <td>{{ $index + 1 }}</td>
                              <td> {{$category->name}} </td>
                              {{-- <td> {{$category->description}} </td> --}}
                              <td class="dt-body-center">
                                <div class="d-inline-block">
                                    <form action="{{ route('dashboard.category.destroy', $category->id) }}"
                                        class="d-inline" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger ml-1">Delete</button>
                                    </form>
                                </div>
                                <div class="d-inline-block">
                                    <button type="button" value="{{ $category->id }}"
                                        data-toggle="modal" data-target="#detail-Category-Modal"
                                        class="btn btn-block btn-info showbtn">Detail</button>
                                </div>
                                <div class="d-inline-block">
                                    <a href="{{ route('dashboard.category.edit', $category->id) }}">
                                        <button class="btn btn-block btn-warning">Edit</button>
                                    </a>
                                </div>
                                <div class="d-inline-block">
                                  <a href="/dashboard/process/category/data/{{$category->id}}">
                                      <button class="btn btn-block btn-success">Process</button>
                                  </a>
                              </div>
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
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@include('dashboard.components.modal.detailCategory')

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
      $("#example1").DataTable({
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
