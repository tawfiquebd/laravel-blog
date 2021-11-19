@extends('frontend.layouts.master')

@section('title', 'Blog - About Page')

@section('styles')

@endsection


@section('content')

    <header class="masthead" style="background-image: url('{{asset('frontend/assets/img/about-bg.jpg')}}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>{{ $about->about_heading ?? '' }}</h1>
                        <span class="subheading">{{ $about->about_short_description ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p> {{ $about->about_description ?? '' }} </p>
                </div>
            </div>
        </div>
    </main>

@endsection


@section('scripts')

@endsection
