@extends('frontend.layouts.master')

@section('title', 'Blog - Contact Page')

@section('styles')

@endsection


@section('content')

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>{{ $contact->contact_heading ?? '' }}</h1>
                        <span class="subheading">{{ $contact->contact_short_description ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p> {{ $contact->contact_description ?? '' }} </p>


                    <div class="my-5">
                        <form id="contactForm" >
                        @csrf
                            <div class="form-floating">
                                <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name..." />
                                <label for="name">Name</label>
                                <small class="help-block text-danger" id="name_help"></small>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email..." />
                                <label for="email">Email address</label>
                                <small class="help-block text-danger" id="email_help"></small>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" name="message" id="message" placeholder="Enter your message here..." style="height: 12rem" ></textarea>
                                <label for="message">Message</label>
                                <small class="help-block text-danger" id="message_help"></small>
                            </div>
                            <br />

                            <button class="btn btn-primary text-uppercase" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection


@section('scripts')
    <script type="text/javascript" src="{{ asset('frontend/partials/contact-us.js') }}"></script>
@endsection
