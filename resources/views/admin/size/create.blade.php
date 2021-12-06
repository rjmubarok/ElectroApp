@extends('admin.layout.layout')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap Tags Input CDN -->
<link rel='stylesheet' href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'>
<style type="text/css">
   .bootstrap-tagsinput .tag {
      margin-right: 2px;
      color: white !important;
      background-color: #4137ce;
      padding: .2em .6em .3em;
      font-size: 100%;
      font-weight: 700;
      vertical-align: baseline;
      border-radius: .25em;
   }
</style>
@endsection
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
                  <a href="  {{route('sizes.index')}} " class="btn btn-success">All Size</a>
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
               <html lang="en">

               <div class="container">
                  <div class="row">
                     <form action="{{route('sizes.store')}}" method="POST">
                        @csrf
                        <div class="col-md-10">
                           <div class="form-group">
                              <label for="size">Size Name</label>
                              <input type="text" name="size" class="form-control w-100" value="{{ old('size') }}" data-role="tagsinput" />
                              @if($errors->has('size'))
                              <strong class="text-danger">{{ $errors->first('size') }}</strong>
                              @endif
                           </div>
                           <button type="submit" class="btn btn-success">Submit</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>
@endsection
@section('script')
<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

<script>
   $(function() {
      $('input').on('change', function(event) {

         var $element = $(event.target);
         var $container = $element.closest('.example');

         if (!$element.data('tagsinput'))
            return;

         var val = $element.val();
         if (val === null)
            val = "null";
         var items = $element.tagsinput('items');

         $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));
         $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));


      }).trigger('change');
   });
</script>
@endsection