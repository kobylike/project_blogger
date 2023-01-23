
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

        @if (Session::has('success'))

<p style="color: green"> {{ Session::get('success') }}</p>
@endif

<br>
<h2>Edit Post</h2>
<div class="container">
    <div class="row">
      <div class="col-md-12">


        <form method="post" action="{{ route('blog.update') }}" role="form" enctype="multipart/form-data">

            @csrf
            <input type="hidden" class="form-control" value="{{$post->id }}" name="id"/>
          <div class="form-group">
            <input type="text" class="form-control" value="{{$post->title }}" name="title" placeholder="Title"/>
          </div>

          @error('title')
            <p style="color: red">{{ $message }}</p>
          @enderror

          <div class="form-group">

            <div class="form-group">
                <label for="title">Image <span class="require">*</span></label>
                <input type="file"  class="form-control" src="{{ asset('storage/posts/'.$post->image) }}"  name="image"/>

            </div>



          @error('image')
          <p style="color: red">{{ $message }}</p>
        @enderror

             <div>

                <select name="category_id" >
                     <option value disabled selected>Select Category</option>=$0


                     <option value="{{ $post->category->id }}">{{ $post->category->name }}</option>



                </select>

          @error('category_id')
          <p style="color: red">{{ $message }}</p>
        @enderror

            </div>
          </div>
          <div class="form-group">
            <textarea class="form-control bcontent" id="body"  name="body" >{{$post->body }}</textarea>
          </div>

          @error('body')
          <p style="color: red">{{ $message }}</p>
        @enderror


          <div class="form-group">
             <input type="submit" name="Submit" value="Publish" class="btn btn-primary form-control" />
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
</main>

<footer>

    <script>
        CKEDITOR.replace( 'body' );
</script>


</footer>

 @endsection
