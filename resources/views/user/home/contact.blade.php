@extends('user.layout.master')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid mt-10">

        <div class="row mt-10">

                <div class="">
                    <div class="row">
                        <div class="col-6 offset-3 mt-5">
                            <div class="card shadow mt-5">
                                <div class="card-body">
                                    <form action="{{ route('contact') }}" method="POST" class="p-3 rounded">
                                        @csrf
                                        <div class="col-6 offset-3 mt-2">
                                            <!-- Page Heading -->
                                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                <h1 class="h3 mb-0 text-gray-800">Contact Us</h1>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-lable">Your Name</label>
                                            <input type="text" value="{{Auth::user()->name}}" readonly name="name" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Enter Your Name">
                                            @error('name')
                                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-lable">Title</label>
                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="" placeholder="Enter Title">
                                            @error('tmail')
                                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-lable">Message</label>
                                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="" cols="30" rows="10" placeholder="Write messages"></textarea>
                                            @error('message')
                                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <input type="submit" class="btn btn-primary" id="" value="Send">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </div>

@endsection
