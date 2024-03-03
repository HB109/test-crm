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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a href="{{ route('employees.create') }}" class="btn btn-block btn-primary float-right">Add Employee</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if (\Session::has('msg'))
                <div class="alert alert-success">
                  <strong>Alert!</strong>{!! \Session::get('msg')!!}
                </div>               
              @endif
              <table id="employee_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Company</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employee as $employee)
                <tr>
                  <td>{{$employee->first_name}}</td>
                  <td>{{$employee->last_name}}</td>
                  <td>{{$employee->email}}</td>
                  <td>{{$employee->phone}}</td>
                  <td>{{$employee->company->name}}</td>
                  <td>
                   
                                <a class="mx-1" href="{{ route('employees.edit', $employee->id) }}"><button class="btn fa fa-edit text-primary"></button></a>
                                <form action="{{ route('employees.destroy', $employee->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class=" btn fa fa-trash text-danger" onclick="return confirm('Are you sure to delete this employee?')"></button>
                                </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Company</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection