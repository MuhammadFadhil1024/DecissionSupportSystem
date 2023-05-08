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
              <a type="button" href="/dashboard/process/category/{{ $categories_id }}/criteria/create" class="btn btn-block btn-outline-primary"> <i class="fas fa-plus nav-icon"></i> Add criteria</a>
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
            <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Criterias</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 10px">#</th>
                          <th class="text-center">Name</th>
                          <th class="text-center" style="width: 20px">Weight</th>
                          <th class="text-center" style="width: 20px">Atribute</th>
                          <th class="text-center" style="width: 40px">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($criterias as $index => $criteria)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $criteria->name }}</td>
                            <td>
                              {{ $criteria->weight }}
                            </td>
                            <td>
                              @if ($criteria->atribute == 0)
                                Benefit
                              @else
                                Cost
                              @endif
                            </td>
                            <td class="">
                              <div class="d-flex justify-content-center">
                                <a href="/dashboard/process/category/{{ $categories_id }}/criteria/{{ $criteria->id }}/edit" class="inline-block badge bg-primary mr-1">Edit</a>
                                <a href="/dashboard/process/category/{{ $categories_id }}/criteria/delete/{{ $criteria->id }}" class="inline-block badge bg-danger">Delete</a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2" class="text-center">Total Weight</th>
                          <td colspan="3" class="text-center">{{ $total_weight }}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item"><a class="page-link" href="#">«</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Explanation</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Task</th>
                              <th>Progress</th>
                              <th style="width: 40px">Label</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1.</td>
                              <td>Update software</td>
                              <td>
                                <div class="progress progress-xs">
                                  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-danger">55%</span></td>
                            </tr>
                            <tr>
                              <td>2.</td>
                              <td>Clean database</td>
                              <td>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-warning" style="width: 70%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-warning">70%</span></td>
                            </tr>
                            <tr>
                              <td>3.</td>
                              <td>Cron job running</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar bg-primary" style="width: 30%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-primary">30%</span></td>
                            </tr>
                            <tr>
                              <td>4.</td>
                              <td>Fix and squish bugs</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar bg-success" style="width: 90%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-success">90%</span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
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
