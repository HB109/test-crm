@extends('layout.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Companies
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
              <h3 class="box-title"><a href="{{ route('companies.create') }}" class="btn btn-block btn-primary float-right">Add Company</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if (\Session::has('msg'))
                <div class="alert alert-success">
                  <strong>Alert!</strong>{!! \Session::get('msg')!!}
                </div>               
              @endif
              <table id="company_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Logo</th>
                  <th>Website</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($company as $company)
                <tr>
                  <td>{{$company->name}}</td>
                  <td>{{$company->email}}</td>
                  <td><img src="{{asset('storage/'.$company->logo)}}" width="100px" height="100px"></td>
                  <td>{{$company->website}}</td>
                  <td>
                   
                                <a class="mx-1" href="{{ route('companies.edit', $company->id) }}"><button class="btn fa fa-edit text-primary"></button></a>
                                <form action="{{ route('companies.destroy', $company->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class=" btn fa fa-trash text-danger" onclick="return confirm('Are you sure to delete this company?')"></button>
                                </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Logo</th>
                  <th>Website</th>
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