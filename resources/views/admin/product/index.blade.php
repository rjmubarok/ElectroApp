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
              <h3 class="card-title">product Table</h3>
              <a href=" {{route('products.create')}} " class=" btn btn-success "> Create Product</a>
            </div>
            @if (Session::has('success'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						<span>{!! \Session::get('success') !!}</span>
						</div>    
						@endif
            @if (Session::has('update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <span>{!! \Session::get('update') !!}</span>
            </div>
            @endif
          </div>
        
          <!-- /.card-header -->
          <div class="card-body">

            <table class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Brand</th>
                  <th>Unit</th>
                  <th>Size</th>
                  <th>Color</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($products->count())


                <tr>
                  @foreach ($products as $product )
                  @php
                $product['image']=explode('|', $product->image);
                @endphp

                  <td>{{ $product->id }} </td>
                  <td>{{ $product->name }} </td>
                  <td>{{ $product->code }} </td>
                  <td>{{ $product->price }} </td>
                  <td>{{ $product->Category->name }} </td>
                  <td>{{ $product->subcategory->name }} </td>
                  <td>{{ $product->brand->name}} </td>
                  <td>{{ $product->unit->name}} </td>

                  <td>
                  @foreach (Json_decode($product->size->size) as $size )
                    <span class="badge badge-info mr-1">
                      {{ $size }}
                    </span>
                    @endforeach
                   </td>
                  <td>
                  @foreach (Json_decode($product->color->color) as $colors )
                    <span class="badge badge-info mr-1">
                      {{ $colors }}
                    </span>
                    @endforeach
                </td>
                  <td>{!! $product->description !!} </td>
                  <td>
                    @if ($product->status==1)
                    <a href="" class="badge btn-success">Active</a>
                    @else
                    <a href="" class="badge btn-danger">Deactive</a>
                    @endif

                  </td>

                <td>
                  @foreach ($product->image as $image )
                    <img src=" {{asset('/image/'.$image)}} " alt="" width="50px" height="50px">
                  @endforeach
                </td>

                  <td class=" d-flex">
                    @if ($product->status==1)
                    <a href="{{route('products.deactive',[$product->id])}}" class="btn btn-danger mr-2">Deactive</a>
                    @else

                    <a href="{{route('products.active',[$product->id])}}" class="btn btn-success mr-2">Active</a>
                    @endif
                    <a href="{{ route('products.edit', [$product->id])}}" class="btn btn-primary btn-sm mr-1">Edit</a>
                    <form action="{{ route('products.destroy', [$product->id])}}"method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm mr-1 bntsize " onclick=" return confirm('Are You Sure To Delete')"> Delete</button>
                    </form>                  
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="14">
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
              <li class="page-item"><a class="page-link" href="#">??</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">??</a></li>
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