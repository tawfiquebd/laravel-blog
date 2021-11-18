@extends('backend.layouts.master')

@section('title', 'Blog - CMS')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">CMS</h1>

    <div class="card shadow mb-4">
        <a href="#aboutPage" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">About Page</h6>
        </a>

        <div class="collapse " id="aboutPage">
            <div class="card-body">

                <form action="{{url('/blogCreate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="title" class="ml-1">About Heading</label>
                            <input type="text" name="about_heading" id="about_heading" class="form-control" value="{{ old('about_heading') }}" placeholder="About Heading" >
                            @if($errors->has('about_heading'))
                                <small class="text-danger ml-1" >{{ $errors->first('about_heading') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="url" class="ml-1">About Short Description</label>
                            <input type="text" name="about_short_description" id="about_short_description" class="form-control" value="{{ old('about_short_description') }}" placeholder="About Short Description" >
                            @if($errors->has('about_short_description'))
                                <small class="text-danger ml-1" >{{ $errors->first('about_short_description') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="title" class="ml-1">Description</label>
                            <textarea name="about_description" id="about_description" class="form-control" rows="4"> {{ old('about_description') }} </textarea>
                            @if($errors->has('about_description'))
                                <small class="text-danger ml-1" >{{ $errors->first('about_description') }}</small>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success float-right">Create</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <a href="#contactPage" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Contact Page</h6>
        </a>

        <div class="collapse " id="contactPage">
            <div class="card-body">

                <form action="{{url('/blogCreate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="title" class="ml-1">Contact Heading</label>
                            <input type="text" name="contact_heading" id="contact_heading" class="form-control" value="{{ old('contact_heading') }}" placeholder="Contact Heading" >
                            @if($errors->has('contact_heading'))
                                <small class="text-danger ml-1" >{{ $errors->first('contact_heading') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="url" class="ml-1">Contact Short Description</label>
                            <input type="text" name="contact_short_description" id="contact_short_description" class="form-control" value="{{ old('contact_short_description') }}" placeholder="Contact Short Description" >
                            @if($errors->has('contact_short_description'))
                                <small class="text-danger ml-1" >{{ $errors->first('contact_short_description') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="title" class="ml-1">Contact Description</label>
                            <textarea name="contact_description" id="contact_description" class="form-control" rows="4"> {{ old('contact_description') }} </textarea>
                            @if($errors->has('contact_description'))
                                <small class="text-danger ml-1" >{{ $errors->first('contact_description') }}</small>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success float-right">Create</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <a href="#footer" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Footer Section</h6>
        </a>

        <div class="collapse " id="footer">
            <div class="card-body">
                <form action="{{url('/blogCreate')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="title" class="ml-1">Twitter Link</label>
                            <input type="text" name="twitter" id="twitter" class="form-control" value="{{ old('twitter') }}" placeholder="www.twitter.com/profile" >
                            @if($errors->has('twitter'))
                                <small class="text-danger ml-1" >{{ $errors->first('twitter') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="url" class="ml-1">Facebook Link</label>
                            <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook') }}" placeholder="www.facebook.com/profile" >
                            @if($errors->has('facebook'))
                                <small class="text-danger ml-1" >{{ $errors->first('facebook') }}</small>
                            @endif
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="title" class="ml-1">Instagram Link</label>
                            <input type="text" name="instagram" id="instagram" class="form-control" value="{{ old('instagram') }}" placeholder="www.instagram.com/profile" >
                            @if($errors->has('instagram'))
                                <small class="text-danger ml-1" >{{ $errors->first('instagram') }}</small>
                            @endif
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success ">Create</button>
                </form>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
{{--    <script type="text/javascript" src="{{ asset('backend/partials/tag.js') }}"></script>--}}
@endsection
