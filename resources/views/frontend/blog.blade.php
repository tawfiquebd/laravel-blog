@extends('frontend.layouts.master')

@section('title', 'Blog Posts')

@section('styles')

@endsection


@section('content')
<!-- Page Header-->
<header class="masthead" style="background-image: url('{{ asset('frontend/assets/img/home-bg.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container-fluid px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5">

        <div class="col-md-3 col-lg-3">
            <div class="card text-center mt-custom border-0">
                <div class="card-header s-header-footer">
                    Apply Filter <i class="fas fa-filter"></i>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Search Blog</h4>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mx-auto">
                            <form action="" method="POST" class="form-group">
                                @csrf
                                <input type="text" name="search" id="search" class="form-control mt-2 mb-2">
                                <small class="text-danger mt-2 mb-2"></small>
                                <button type="submit" class="btn btn-danger w-100 rounded mt-2 mb-2">Search  <i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <hr>

                    <h4 class="card-title">By Categories</h4>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mx-auto">
                            <h5><a href="" class="mt-2 mb-2">1st</a></h5>
                            <h5><a href="" class="mt-2 mb-2">2nd</a></h5>
                            <h5><a href="" class="mt-2 mb-2">3rd</a></h5>
                            <h5><a href="" class="mt-2 mb-2">4th</a></h5>
                        </div>
                    </div>

                    <hr>

                    <h4 class="card-title">By Tags</h4>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mx-auto">
                            <h5><a href="" class="mt-2 mb-2">1st</a></h5>
                            <h5><a href="" class="mt-2 mb-2">2nd</a></h5>
                            <h5><a href="" class="mt-2 mb-2">3rd</a></h5>
                            <h5><a href="" class="mt-2 mb-2">4th</a></h5>
                        </div>
                    </div>

                </div>
                <div class="card-footer s-header-footer">

                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <!-- Post preview-->
            @foreach($blogs as $blog)
            <div class="post-preview">
                <a href="{{ url('/blog/'.$blog->url) }}">
                    <h2 class="post-title">{{ Str::words($blog->title, 10, '...') ?? '' }}</h2>
                    <h3 class="post-subtitle">{{ Str::limit($blog->short_description, 100, '...') ?? '' }}</h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!">{{ $blog->user->name ?? '' }}</a>
                    {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                </p>
            </div>

            {{--  if this loops last element then show <hr/> --}}
            @if(!$loop->last)
                <hr class="my-4" />
            @endif

            @endforeach

        </div>

        <div class="col-md-3 col-lg-3">
        </div>

    </div>

    <div class="row">
        <!-- Pagination-->
        <div class="col-12">
            <nav aria-label="pagination">
                <ul class="pagination justify-content-center">
                    {{ $blogs->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </div>
    </div>

</div>

@endsection


@section('scripts')

@endsection
