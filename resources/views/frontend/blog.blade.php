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
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            @foreach($blogs as $blog)
            <div class="post-preview">
                <a href="{{ url('/blog-details') }}">
                    <h2 class="post-title">{{ Str::limit($blog->title, 50, '...') ?? '' }}</h2>
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
