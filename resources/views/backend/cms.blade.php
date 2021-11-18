@extends('backend.layouts.master')

@section('title', 'Blog - CMS')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">CMS</h1>

    @include('backend.partials.aboutForm')

    @include('backend.partials.contactForm')

    @include('backend.partials.footerForm')

@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('backend/partials/about.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/partials/contact.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/partials/footer.js') }}"></script>
@endsection
