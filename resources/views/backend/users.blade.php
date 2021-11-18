@extends('backend.layouts.master')

@section('title', 'Blog - Users')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Users</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>

        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered w-100" id="allUsers">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>


@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('backend/partials/users.js') }}"></script>
@endsection
