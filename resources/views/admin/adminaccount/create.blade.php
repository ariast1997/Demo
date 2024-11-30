@extends('admin.layout.master')

@section('content')

    <div class="container">

        {{-- search key --}}
        <div class="row">
            <div class="col-6 offset-3 p-3 card">

                {{-- admin list  --}}
                <div class="d-flex justify-content-end">
                    <a href="{{route('admin#list')}}" class="btn btn-danger text white mb-2 shadow-sm">Admin List</a>
                </div>

                {{-- create new admin  --}}
                <div class="card-title d-flex justify-content-center bg-primary text-white">New admin account</div>
                <form action="{{route('add#admin')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-lable">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Enter name..." value="{{old('name')}}">
                            @error('name')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-lable">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="" placeholder="Enter email..." value="{{old('email')}}">
                            @error('email')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-lable">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="" placeholder="Enter phone..." value="{{old('phone')}}">
                            @error('phone')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-lable">Password</label>
                            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="" placeholder="Enter password...">
                            @error('password')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-lable">Confirm Password</label>
                            <input type="text" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" id="" placeholder="confirm password...">
                            @error('confirmPassword')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="submit" name="" id="" value="Create account" class="btn btn-primary w-100 ">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
