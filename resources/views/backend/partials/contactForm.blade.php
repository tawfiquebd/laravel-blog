<div class="card shadow mb-4">
    <a href="#contactPage" class="d-block card-header py-3" data-toggle="collapse"
       role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Contact Page</h6>
    </a>

    <div class="collapse " id="contactPage">
        <div class="card-body">

            <form action="" id="contactCms" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="contact_section_name" id="contact_section_name" value="{{$contact_section->section_name ?? ''}}">

                <div class="form-row">
                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="title" class="ml-1">Contact Heading</label>
                        <input type="text" name="contact_heading" id="contact_heading" class="form-control" value="{{ $contact_section->contact_heading ?? ''  }}" placeholder="Contact Us" >

                        <small id="contact_heading_help" class="text-danger ml-1" ></small>

                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="url" class="ml-1">Contact Short Description</label>
                        <input type="text" name="contact_short_description" id="contact_short_description" class="form-control" value="{{ $contact_section->contact_short_description ?? '' }}" placeholder="Contact Short Description" >

                        <small id="contact_short_description_help" class="text-danger ml-1" ></small>

                    </div>

                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="title" class="ml-1">Description</label>
                        <textarea name="contact_description" id="contact_description" class="form-control" rows="4"> {{ $contact_section->contact_description ?? '' }} </textarea>

                        <small id="contact_description_help" class="text-danger ml-1" ></small>

                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update</button>

            </form>
        </div>
    </div>
</div>
