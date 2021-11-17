@extends('backend.layouts.master')

@section('title', 'Blog - Awaiting Approval')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Awaiting Blogs</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Awaiting Blogs</h6>

        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered w-100" id="awaiting">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">User</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">Short Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Awaiting</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('backend/partials/awaiting.js') }}"></script>
@endsection
