
<!------ Include the above in your HEAD tag ---------->
@extends('layout.app')


@section('content')

 @include('inc.nav')


 <style>

.btn-file {
    position: relative;
    overflow: hidden;
}

.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 50%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

input[readonly] {
  background-color: white !important;
  cursor: text !important;
}

/* this is only due to codepen display don't use this outside of codepen */
.container {
  padding-top: 20px;
}
    </style>

<script type="text/javascript">
    CKEDITOR.replace("body");
</script>



<main style="margin-top: 58px">
    <div class="container pt-4">
        <br>

    @if (Session::has('success'))
    <p style="color: green"> {{ Session::get('success') }}</p>
@endif

        <h2>Edit Category</h2>

<div class="container">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('category.update') }}" role="form" >
            @csrf
            <input type="hidden" value="{{$category->id }}" name="id"/>
          <div class="form-group">
            <input type="text" class="form-control" value="{{$category->name }}" name="name" placeholder="Category Name"/>
          </div>

          @error('name')

          <p style="color: red"> {{ $message }}</p>
          @enderror
          <br>


          <div class="form-group">
             <input type="submit" name="Submit" value="Publish" class="btn btn-primary form-control" />
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</main>



 @endsection
