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
                        <a href="  {{route('categories.index')}} " class="btn btn-success">All Categories</a>
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
                    <form action="{{route('categories.update',[$category->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Category" name="name" value="{{ $category->name}} ">
                            </div>
                            <div class="mb-3">
                              <label for="description" class="form-label">Description</label>
                              <textarea name="description" id="summernote"  class="form-control w-100 @error('description') is-invalid @enderror" placeholder="Enter Description"> {{ $category->description }} </textarea>
                             
                              </div>
                              <div class="mb-3">
										<div class="form-group">
											<label class="form-control-label"> Image <span class="tx-danger"></span></label>
											<input class="form-control  @error('image') is-invalid @enderror" type="file" name="image"value="">
											
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