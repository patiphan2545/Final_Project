@extends('layouts.app')
@section('content')

@include('layouts.partials.nav')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@if(isset($page_title)){{$page_title}}@endif</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">@if(isset($page_title)){{$page_title}}@endif</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li class="text-capitalize">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          @if(session('msg'))
          <div class="alert alert-info alert-sm alert-dismissible">{{session('msg')}}</div>
          @endif
          <div class="col-md-10">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <form method="POST" action="{{route('posts.save')}}" enctype="multipart/form-data">
                  @csrf()
                  <div class="card-body">
                    @if(session('msg'))
                    <div class="alert alert-info alert-sm alert-dismissible">{{session('msg')}}</div>
                    @endif
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="name">Student Name</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Image</label>
                          <input type="file" class="form-control" name="postimage">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="name">Student ID</label>
                          <input type="text" class="form-control" name="content" required>
                        </div>
                      </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
@endsection('content')
