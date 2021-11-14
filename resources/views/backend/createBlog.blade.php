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

    <div class="row">
        <div class="col-xl-12 col-log-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{url('/blogCreate')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="ml-1">Blog Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="" placeholder="My First Blog" required>
                                <small class="text-danger ml-1" ></small>
                            </div>

                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="url" class="ml-1">Url</label>
                                <input type="text" name="url" id="url" class="form-control" value="" placeholder="My-first-blog" required>
                                <small class="text-danger ml-1" ></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="ml-1">Select Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option>-- Select Category --</option>
                                    <option value="">PHP</option>
                                    <option value="">JavaScript</option>
                                </select>
                                <small class="text-danger ml-1" ></small>
                            </div>

                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="url" class="ml-1">Select Tags</label>
                                <select class="form-control tags" multiple name="tags[]" id="tags[]">
                                    <option>Blogging</option>
                                    <option>Best Blog</option>
                                </select>
                                <small class="text-danger ml-1" ></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="ml-1">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                                <small class="text-danger ml-1" ></small>
                            </div>

                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="url" class="ml-1">Image Alt Text</label>
                                <input type="text" name="image_alt" id="image_alt" class="form-control" placeholder="My Home Picture" required value="">
                                <small class="text-danger ml-1" ></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="title" class="ml-1">Meta Text</label>
                                <input type="text" name="meta" id="meta" class="form-control" placeholder="Eg. This is my first blog">
                                <small class="text-danger ml-1" ></small>
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="title" class="ml-1">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control" rows="4"></textarea>
                                <small class="text-danger ml-1" ></small>
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="title" class="ml-1">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                <small class="text-danger ml-1" ></small>
                            </div>
                        </div>

                        <div class="form-check mb-2">
                            <input type="checkbox" name="active" id="active" class="form-check-input" checked>
                            <label for="active" class="form-check-label">Publish Blog</label>
                        </div>

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
    </script>
@endsection
