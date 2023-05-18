@extends('dashboard.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

{{-- @dd($categories_id) --}}

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-7">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Alternatives</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="dt-head-center" style="width: 15px">No</th>
                            <th class="dt-head-center">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($alternatives as $index => $alternative)
                            <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $alternative->name }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      <ul class="pagination pagination-sm m-0 float-right">
                        <td>
                          <a href="/dashboard/process/category/{{ $categories_id }}/alternative" class="btn btn-block btn-outline-success btn-sm"><span class="px-4">See all</span></a>
                        </td>
                      </ul>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-5">
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
                              </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            {{-- <tr>
                              <th colspan="2" class="text-center">Total Weight</th>
                              <td colspan="3" class="text-center">{{ $total_weight }}</td>
                            </tr> --}}
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                          <td>
                            <a href="/dashboard/process/category/{{ $categories_id }}/criteria" class="btn btn-block btn-outline-success btn-sm"><span class="px-4">See all</span></a>
                          </td>
                        </ul>
                      </div>
                    </div>
                  <!-- /.card -->
                </div>
          </div>
        </div><!-- /.container-fluid -->
      </section><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
