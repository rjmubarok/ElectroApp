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
                        <a href="  {{route('products.index')}} " class="btn btn-success">All Product</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span>{!! \Session::get('success') !!}</span>
                    </div>
                    @endif
                    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Code</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter product Code" name="code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Price</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter product Price" name="price">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <select name="category" id="" class="form-control">
                                            <option value="" style="display: none;" selected>Select Category</option>
                                            @foreach ($categories as $category )
                                            <option value=" {{$category->id}} "> {{ $category->name }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"> Sub Category Name</label>
                                        <select name="subcategory" id="" class="form-control">
                                            <option value="" style="display: none;" selected>Select Sub Category</option>
                                            @foreach ($subcategories as $subcategory )
                                            <option value=" {{$subcategory->id}} "> {{ $subcategory->name }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"> Brand Name</label>
                                        <select name="brand" id="" class="form-control">
                                            <option value="" style="display: none;" selected>Brand</option>
                                            @foreach ($brands as $brand )
                                            <option value=" {{$brand->id}} "> {{ $brand->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"> Unit </label>
                                        <select name="unit" id="" class="form-control">
                                            <option value="" style="display: none;" selected>Select Unit</option>
                                            @foreach ($units as $unit )
                                            <option value=" {{$unit->id}} "> {{ $unit->name }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Color </label>
                                        <select name="color" id="" class="form-control">
                                            <option value="" style="display: none;" selected>Select Color</option>
                                            @foreach ($colors as $color )
                                            <option value=" {{$color->id}} ">  @foreach (Json_decode($color->color) as $colors )
                                                <span class="badge badge-info mr-1">
                                                {{ $colors }}
                                                </span>
                                                @endforeach </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"> Size</label>
                                        <select name="size" id="" class="form-control">
                                            <option value="" style="display: none;" selected>Select Size</option>
                                            @foreach ($sizes as $size )
                                            <option value=" {{$size->id}} ">  @foreach (Json_decode($color->color) as $colors )
                                                <span class="badge badge-info mr-1">
                                                {{ $colors }}
                                                </span>
                                                @endforeach </option>
                                                   @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="summernote" class="form-control w-100 @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description')}}</textarea>

                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-control-label">Main Thambnail <span class="tx-danger"></span></label>
                                    <input class="form-control  @error('image') is-invalid @enderror" type="file" name="file[]" value="{{old('image_one')}}" multiple>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection
