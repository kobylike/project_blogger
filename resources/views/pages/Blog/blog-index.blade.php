@extends('layout.app')


@section('content')

 @include('inc.nav')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/.index') }}">Home</a></li>
          <li>Blog</li>
        </ol>
        <h2>Blog</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

            @if (Session::has('success'))
                <p style="color: green"> {{ Session::get('success') }}</p>
            @endif




          <div class="col-lg-8 entries">
            @forelse ($posts as $post )
            <article class="entry">
              <div class="entry-img">

                @auth
                    @if (auth()->user()->id ==$post->user->id)

                    <button type="button" ><a class="btn btn-danger" href="{{ route('blog.delete', $post) }}">Delete</a></button>
                    <button type="button" ><a class="btn btn-primary" href="{{ route('blog.edit', $post) }}">Edit</a></button>

                    @endif
                @endauth
                <img src="{{ $post->image }}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $post->user->name }}</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time> {{ $post->created_at->diffForHumans() }}</time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">{{ $post->comments->count() }} Comments</a></li>
                </ul>
              </div>
              <div class="entry-content">
                <p>
                     {!! Str::limit( $post->body,150) !!}
                </p>
                <div class="read-more">
                  <a href="{{ route('blog.show', $post) }}">Read More</a>
                </div>
              </div>
            </article><!-- End blog entry -->

            @empty
            <p>Search of found</p>
            @endforelse





            <!-- End blog entries list -->
            {{-- <div class="blog-pagination">
                <ul class="justify-content-center">


                  {{ $posts->links('pagination::bootstrap-5') }}
                </ul>
              </div> --}}


            </div>

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">

                <form action="">
                  <input type="text" name="search">
                  <button type="submit"><i class="bi bi-search" ></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                    @foreach ($categories as $category )


                  <li><a href="{{ route('blog.index', ['category' => $category->name]) }}">{{ $category->name }} <span>({{ $category->posts->count() }})</span></a></li>
                  @endforeach

                </ul>
              </div><!-- End sidebar categories-->



              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

          {{ $posts->links('pagination::bootstrap-5') }}

        </div>

      </div>

    </section><!-- End Blog Section -->

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



@endsection
