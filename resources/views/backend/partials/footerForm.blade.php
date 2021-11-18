<div class="card shadow mb-4">
    <a href="#footerCms" class="d-block card-header py-3" data-toggle="collapse"
       role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Footer Section</h6>
    </a>

    <div class="collapse " id="footerCms">
        <div class="card-body">

            <form action="" id="footerSection" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="footer_section_name" id="footer_section_name" value="{{$footer_section->section_name ?? ''}}">

                <div class="form-row">
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="title" class="ml-1">Twitter</label>
                        <input type="text" name="twitter" id="twitter" class="form-control" value="{{ $footer_section->twitter?? ''  }}" placeholder="Twitter Link" >

                        <small id="twitter_help" class="text-danger ml-1" ></small>

                    </div>

                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="url" class="ml-1">Facebook</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $footer_section->facebook ?? '' }}" placeholder="Facebook Link" >

                        <small id="facebook_help" class="text-danger ml-1" ></small>

                    </div>

                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="url" class="ml-1">Instagram</label>
                        <input type="text" name="instagram" id="instagram" class="form-control" value="{{ $footer_section->instagram ?? '' }}" placeholder="Instagram Link" >

                        <small id="instagram_help" class="text-danger ml-1" ></small>

                    </div>

                </div>

                <button type="submit" class="btn btn-success">Update</button>

            </form>
        </div>
    </div>
</div>
