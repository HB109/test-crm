@extends('layout.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employees
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-xs-12">
             <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong> <br>
                    <ul>
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </ul>
                </div>
            @endif
            <form role="form" method="post" action="{{ route('employees.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Enter first name" value="{{old('first_name')}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter last name" value="{{old('last_name')}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone</label>
                  <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone" value="{{old('phone')}}">
                </div>
                  <div class="form-group">
                  <label>Select</label>
                    <select class="form-control" name="company_id">
                       @foreach ($company as $key=>$company)
                    <option value="{{ $key }}" >{{ $company }}</option>
                @endforeach

                    </select>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
            <!-- /.box-body -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection