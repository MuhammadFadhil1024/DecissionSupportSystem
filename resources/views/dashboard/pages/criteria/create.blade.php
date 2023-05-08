@extends('dashboard.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
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
            <div class="row">
                <div class="col-sm-8">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Add new criteria</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/dashboard/process/category/{{ $categories_id }}/criteria/store" method="POST">
                      @csrf
                      <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{old('name')}}" name="name">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Weight</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{old('weight')}}" name="weight">
                          </div>
                          <div class="form-group">
                            <label for="exampleSelectBorder">Atribut</label>
                            <select class="custom-select form-control-border" name="atribute" id="exampleSelectBorder">
                              <option value="1">Cost</option>
                              <option value="0">Benefit</option>
                            </select>
                          </div>
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
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
