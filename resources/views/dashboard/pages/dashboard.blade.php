@extends('dashboard.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}
          <!-- ./col -->
          {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                
                <h3>{{ $users_count }}</h3>
                <p>User on this aplication</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="{{ route('dashboard.user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $categories->count() }}</h3>

                <p>Total of Category</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('dashboard.category.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <div class="container-fluid mt-3">
        <div class="row">
          @foreach ($categories as $index => $category)
            <div class="col-md-4 col-sm-6 col-12">
              {{-- <div class="info-box @if ($category->id % 2 == 0) bg-blue @endif bg-green"> --}}
              @if ($index % 2 == 0)
                <div class="info-box bg-green"> 
              @else
                <div class="info-box bg-blue"> 
              @endif
                <span class="info-box-icon"><i class="nav-icon fas fa-copy"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">{{ $category->name }}</span>
                  {{-- <span class="info-box-number">Alternatives : {{ $category->alternatives()->count() }}</span>
                  <span class="info-box-number">Criteria : {{ $category->criteria()->count() }}</span> --}}
                  <span class="progress-description">
                    <span class="badge badge-light">Alternative : {{ $category->alternatives()->count() }}</span>
                    <span class="badge badge-light">Criteria : {{ $category->criteria()->count() }}</span>
                    {{-- <a href="" class="badge badge-light">Detail</a> --}}
                  </span>
                  <span class="progress-description">
                    {{-- <span class="badge badge-light">Criteria : {{ $category->criteria()->count() }}</span> --}}
                    <a href="/dashboard/process/category/data/{{$category->id}}" class="badge badge-light">Detail</a>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
