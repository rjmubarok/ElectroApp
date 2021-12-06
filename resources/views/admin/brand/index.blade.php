@extends('admin.layout.layout')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-2"></div>
      <div class="col-md-10 p-5">
        <!-- general form elements -->
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Brand Table</h3>
              <a href=" {{route('brand.create')}} " class=" btn btn-success "> Create Brand</a>
            </div>
            @if (Session::has('success'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<span>{!! \Session::get('success') !!}</span>
						</div>
						@endif
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($brands->count())


                <tr>
                  @foreach ($brands as $brand )

                  <td>{{ $brand->id }} </td>
                  <td>{{ $brand->name }} </td>
                  <td>{!! $brand->description !!} </td>
                  <td>
                    @if ($brand->status==1)
                    <a href="" class="badge btn-success">Active</a>
                    @else
                    <a href="" class="badge btn-danger">Deactive</a>
                    @endif

                  </td>
                  <td class=" d-flex">
                    @if ($brand->status==1)
                    <a href="{{route('brand.deactive',[$brand->id])}}" class="btn btn-danger mr-2">Deactive</a>
                    @else

                    <a href="{{route('brand.active',[$brand->id])}}" class="btn btn-success mr-2">Active</a>
                    @endif
                    <a href="{{ route('brand.edit', [$brand->id])}}" class="btn btn-primary btn-sm mr-1">Edit</a>
                    <form action="{{ route('brand.destroy', [$brand->id])}}"method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm mr-1 bntsize " onclick=" return confirm('Are You Sure To Delete')"> Delete</button>
                    </form>
                   
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="6">
                    <h5 class="text-center">No product Found</h5>
                  </td>
                </tr>
                @endif
              </tbody>
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
      </div>
    </div>
  </div>
</section>
<style>
  .bntsize{
    padding: 7.5px;
  }
</style>
@endsection