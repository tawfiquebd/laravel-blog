@if($blogs->count() == 0)
    @if(!empty($categoryName))
        <div class="col-md-12">
            <div class="offset-md-3 col-md-6 col-lg-6">
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Search result for category: {{ $categoryName ?? '' }} </strong>
                    <br>
                    <strong>Not Found <i class="far fa-frown"></i> </strong>
                    <br>
                    <a href="{{ url('/') }}" class="btn btn-sm btn-danger rounded">Return to Blogs</a>

                </div>
            </div>
        </div>
    @elseif(!empty($tagName))
        <div class="col-md-12">
            <div class="offset-md-3 col-md-6 col-lg-6">
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Search result for tag: {{ $tagName ?? '' }} </strong>
                    <br>
                    <strong>Not Found <i class="far fa-frown"></i> </strong>
                    <br>
                    <a href="{{ url('/') }}" class="btn btn-sm btn-danger rounded">Return to Blogs</a>

                </div>
            </div>
        </div>
    @elseif(!empty($search))
        <div class="col-md-12">
            <div class="offset-md-3 col-md-6 col-lg-6">
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Search result for : {{ $search ?? '' }} </strong>
                    <br>
                    <strong>Not Found <i class="far fa-frown"></i> </strong>
                    <br>
                    <a href="{{ url('/') }}" class="btn btn-sm btn-danger rounded">Return to Blogs</a>

                </div>
            </div>
        </div>
    @endif
@else
    @if(!empty($categoryName))
        <div class="col-md-12">
            <div class="offset-md-3 col-md-6 col-lg-6">
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Search result for category: {{ $categoryName ?? '' }} </strong>
                    <br>
                    <a href="{{ url('/') }}" class="btn btn-sm btn-danger rounded">Return to Blogs</a>

                </div>
            </div>
        </div>
    @elseif(!empty($tagName))
        <div class="col-md-12">
            <div class="offset-md-3 col-md-6 col-lg-6">
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Search result for tag: {{ $tagName ?? '' }} </strong>
                    <br>
                    <a href="{{ url('/') }}" class="btn btn-sm btn-danger rounded">Return to Blogs</a>

                </div>
            </div>
        </div>
    @elseif(!empty($search))
        <div class="col-md-12">
            <div class="offset-md-3 col-md-6 col-lg-6">
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>Search result for : {{ $search ?? '' }} </strong>
                    <br>
                    <a href="{{ url('/') }}" class="btn btn-sm btn-danger rounded">Return to Blogs</a>

                </div>
            </div>
        </div>
    @endif
@endif
