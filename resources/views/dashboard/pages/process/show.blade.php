@extends('dashboard.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/dashboard/process/category/data/{{ $categories_id }}/result" class="ml-3">
                {{-- <h6 class="ml-3"> --}}
                    <i class="nav-icon fas fa-backward"></i>
                    <span class="ml-1 text-lg">Back</span>
                {{-- </h6> --}}
            </a>
            {{-- <td> --}}
              {{-- <a type="button" href="/dashboard/process/category/data/{{ $categories_id }}/generate" class="btn btn-block btn-outline-primary"> <i class="nav-icon fas fa-sync"></i>  Generate</a> --}}
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 20%">Id</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{ $alternative->alternative_code }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Name</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{ $alternative->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Values</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">Criteria</th>
                            <th class="text-center">Value</th>
                            <th class="text-center">Normalization</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($alternative->values as $value)
                            <tr>
                              <td>{{ $value->criterias->name }}</td>
                              <td>{{ $value->value }}</td>
                              <td>{{ $value->normalization }}</td>
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
