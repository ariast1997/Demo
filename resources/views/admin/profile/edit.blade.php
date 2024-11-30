@extends('admin.layout.master')

@section('content')
    {{-- Begin Page Content  --}}
    <div class="container-fluid">

        {{-- Data Table Example --}}
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Admin Profile</h6>
                </div>
            </div>
        </div>
        <form action="{{route('edit#update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <input type="hidden" name="oldImage" id="">

                            <img src="{{asset(Auth::user()->profile != null ? 'profile/'.Auth::user()->profile : 'admin/img/undraw_profile')}}  " width="100" alt="" class="image-profile image-thumbnail" id="output">

                        <input type="file" name="image" id=""
                            class="form-control mt-3 " onchange="loadFile(event)">

                    </div>
                    <div class="col">

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-lable">Name</label>
                                    <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror " id="" value="{{old('name',auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name)}}">
                                    @error('name')
                                        <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-lable">Email</label>
                                    <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror " id="" value="{{old('email',auth()->user()->email)}}">
                                    @error('email')
                                        <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-lable">Phone</label>
                                    <input type="text" name="phone" placeholder="09xxxxx"
                                    class="form-control @error('phone') is-invalid @enderror " id="" value="{{old('phone',auth()->user()->phone)}}">
                                    @error('phone')
                                        <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-lable">Address</label>
                                    <input type="text" name="address"
                                    class="form-control @error('address') is-invalid @enderror " id="" value="{{old('address',auth()->user()->address)}}">
                                    @error('address')
                                        <small>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <input type="submit" name="" id="" value="Update" class="btn btn-primary mt-3">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
