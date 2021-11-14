@extends('backend.layouts.master')

@section('title', 'Blog - Blogs')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Blogs</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Blogs</h6>
            <a href="{{ url('/createBlog') }}" class="float-right btn btn-success">Add Blog</a>

        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered w-100" id="blogs">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>

@endsection


@section('scripts')
{{--    <script type="text/javascript" src="{{ asset('backend/partials/blog.js') }}"></script>--}}
@endsection
