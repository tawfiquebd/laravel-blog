@extends('backend.layouts.master')

@section('title', 'Blog - Contact Messages')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Contact Messages</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Contact Messages</h6>

        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered w-100" id="msg">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Emil</th>
                    <th scope="col">Message</th>
                    <th scope="col">Created At</th>
                    <th scope="col">View</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>

    @include('backend.partials.msgModal')

@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('backend/partials/message.js') }}"></script>
@endsection
