<div class="card shadow mb-4">
    <a href="#aboutPage" class="d-block card-header py-3" data-toggle="collapse"
       role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">About Page</h6>
    </a>

    <div class="collapse " id="aboutPage">
        <div class="card-body">

            <form action="" id="aboutCms" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="about_section_name" id="about_section_name" value="{{$about_section->section_name ?? ''}}">

                <div class="form-row">
                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="title" class="ml-1">About Heading</label>
                        <input type="text" name="about_heading" id="about_heading" class="form-control" value="{{ $about_section->about_heading ?? ''  }}" placeholder="About Heading" >

                        <small id="about_heading_help" class="text-danger ml-1" >{{ $errors->first('about_heading') }}</small>

                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="url" class="ml-1">About Short Description</label>
                        <input type="text" name="about_short_description" id="about_short_description" class="form-control" value="{{ $about_section->about_short_description ?? '' }}" placeholder="About Short Description" >

                        <small id="about_short_description_help" class="text-danger ml-1" >{{ $errors->first('about_short_description') }}</small>

                    </div>

                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="title" class="ml-1">Description</label>
                        <textarea name="about_description" id="about_description" class="form-control" rows="4"> {{ $about_section->about_description ?? '' }} </textarea>

                        <small id="about_description_help" class="text-danger ml-1" >{{ $errors->first('about_description') }}</small>

                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update</button>

            </form>
        </div>
    </div>
</div>
