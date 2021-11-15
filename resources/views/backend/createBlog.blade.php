@extends('backend.layouts.master')

@section('title', 'Blog - Create Blog')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .ck-editor__editable_inline {
            height: 350px;
        }
    </style>
@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Create Blog <a href="{{ url('/blogs') }}" class="btn btn-dark float-right">Return To Blogs</a> </h1>

    @if(count($errors) != 0)
        @if(count($errors) == 1)
            <div class="alert alert-danger">
                There is 1 error in the form please correct the error to proceed.
            </div>
        @else
            <div class="alert alert-danger">
                There are {{ count($errors) }} errors in the form please correct the error to proceed.
            </div>
        @endif
    @endif

    <div class="row">
        <div class="col-xl-12 col-log-8">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <form action="{{url('/blogCreate')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="ml-1">Blog Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="My First Blog" >
                                @if($errors->has('title'))
                                <small class="text-danger ml-1" >{{ $errors->first('title') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="url" class="ml-1">Url</label>
                                <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}" placeholder="My-first-blog" >
                                @if($errors->has('url'))
                                    <small class="text-danger ml-1" >{{ $errors->first('url') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="ml-1">Select Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option {{ old('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category'))
                                    <small class="text-danger ml-1" >{{ $errors->first('category') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="url" class="ml-1">Select Tags</label>
                                <select class="form-control tags" multiple name="tags[]" id="tags[]">
                                    @foreach($tags as $tag)
                                        <option @if(old('tags')) {{ in_array($tag->id, old('tags')) ? 'selected' : '' }} @endif value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tags'))
                                    <small class="text-danger ml-1" >{{ $errors->first('tags') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="ml-1">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                                @if($errors->has('image'))
                                    <small class="text-danger ml-1" >{{ $errors->first('image') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="url" class="ml-1">Image Alt Text</label>
                                <input type="text" name="image_alt" id="image_alt" class="form-control" placeholder="My Home Picture" value="{{ old('image_alt') }}">
                                @if($errors->has('image_alt'))
                                    <small class="text-danger ml-1" >{{ $errors->first('image_alt') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="title" class="ml-1">Meta Text</label>
                                <input type="text" name="meta" id="meta" class="form-control" value="{{ old('meta') }}" placeholder="Eg. This is my first blog">
                                @if($errors->has('meta'))
                                    <small class="text-danger ml-1" >{{ $errors->first('meta') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="title" class="ml-1">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control" rows="4"> {{ old('short_description') }} </textarea>
                                @if($errors->has('short_description'))
                                    <small class="text-danger ml-1" >{{ $errors->first('short_description') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="title" class="ml-1">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4"> {{ old('description') }} </textarea>
                                @if($errors->has('description'))
                                    <small class="text-danger ml-1" >{{ $errors->first('description') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-check mb-2">
                            <input type="checkbox" name="active" id="active" class="form-check-input" checked>
                            <label for="active" class="form-check-label">Publish Blog</label>
                        </div>

                        <button type="submit" class="btn btn-success float-right">Create</button>
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
        $(".tags").select2({
            placeholder: "Select Tags",
            allowClear: true
        });

        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );


        // Success Swal
        let success = "{{ session('success') ?? '' }}";
        setTimeout(function() {
            if(success !== '') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Blog created successfully.',

                });
            }
        },500);


    </script>
@endsection
