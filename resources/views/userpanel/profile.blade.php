@extends('userpanel.layouts.master')

@section('title', 'Blog - Profile')


@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Profile </h1>

    <div class="row">
        <div class="col-xl-6 col-lg-6 offset-md-3">
            <div class="card shadow mb-4">
                <h5 class="card-header"> Update Username and Email</h5>
                <div class="card-body">
                    <form action="{{url('/user/profile/update')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="username" class="ml-1">Name</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{ $user->name ?? '' }}" placeholder="Username..." >
                                @if($errors->has('username'))
                                    <small class="text-danger ml-1" >{{ $errors->first('username') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="email" class="ml-1">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email ?? '' }}" placeholder="Email..." >
                                @if($errors->has('email'))
                                    <small class="text-danger ml-1" >{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 offset-md-3">
            <div class="card shadow mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form action="{{url('/user/update/password')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="old_password" class="ml-1">Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password..." >
                                @if(session()->has('error'))
                                    <small class="text-danger ml-1" >{{ session()->get('error') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="password" class="ml-1">New Password</label>
                                <input type="password" name="password" id="old_password" class="form-control" placeholder="New Password..." >
                                @if($errors->has('password'))
                                    <small class="text-danger ml-1" >{{ $errors->first('password') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="password_confirmation" class="ml-1">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password..." >
                                @if($errors->has('password_confirmation'))
                                    <small class="text-danger ml-1" >{{ $errors->first('password_confirmation') }}</small>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript">

        // Success Swal
        let success = "{{ session('success') ?? '' }}";
        setTimeout(function() {
            if(success !== '') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Profile settings updated successfully.',

                });
            }
        },500);


    </script>
@endsection
