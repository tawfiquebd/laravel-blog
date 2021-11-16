@extends('frontend.layouts.master')

@section('meta')
    {{ $blog->meta ?? '' }}
@endsection

@section('title', 'Blog - Blog Details')

@section('styles')

@endsection


@section('content')

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('frontend/assets/img/post-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>{{ $blog->title ?? '' }}</h1> <br>
                        <span class="meta mb-3"> Category :
                            <a href="#" class="badge badge-danger"> {{ $blog->category->name ?? '' }} </a>
                        </span>
                        <span class="meta mb-3"> Tags :
                            @foreach($blog->tags as $tag)
                            <a href="#" class="badge badge-success"> {{ $tag->name ?? '' }} </a>
                            @endforeach
                        </span>
                        <span class="meta">
                            Posted by
                            <a href="#!">{{ $blog->user->name ?? '' }}</a>
                            on {{ Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <blockquote class="blockquote"> {{ $blog->short_description ?? ''}} </blockquote>

                    <div class="text-center">
                        <a href="#!"><img class="img-fluid rounded" src="{{ asset('images/blogImages/'.$blog->image) }}" alt="{{ $blog->image_alt ?? '' }}" /></a>
                    </div>

                    <p> {!! $blog->description ?? '' !!} </p>

                </div>
            </div>
        </div>
    </article>

@endsection


@section('scripts')

@endsection
