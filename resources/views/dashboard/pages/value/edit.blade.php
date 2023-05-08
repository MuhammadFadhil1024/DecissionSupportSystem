@extends('dashboard.layouts.app')

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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit value : {{ $alternative_value->name }} - {{ $alternative_value->alternative_code }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/dashboard/process/category/{{ $categories_id }}/value/update" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        @foreach ($alternative_value->values as $index => $value)
                            <input type="hidden" value="{{ $value->id }}" name="value[{{$index}}][value_id]">
                            <div class="col">
                                <div class="form-group">
                                <label for="exampleInputEmail1">{{ $value->criterias->name }}</label>
                                <input type="text" required class="form-control" id="exampleInputEmail1" value="{{ $value->value }}" name="value[{{$index}}][value]">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
