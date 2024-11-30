@extends('admin.layout.master')

@section('content')
    {{-- Begin Page Content --}}
    <div class="container-flud">

        {{-- Data Table Example --}}
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Account Information</h6>
                    </div>
                </div>
            </div>
            <form action="">
                @csrf
                <div class="card-body">
                    <div class="row col-10">
                        <div class="col-3">
                            <img src="{{asset(Auth::user()->profile != null ? 'profile/'.Auth::user()->profile : 'admin/img/undraw_profile.svg')}}" width="100" alt="" class="img-profile " id="output" >
                        </div>
                        <div class="col">

                            <div class="row mt-3">
                                <div class="col-2 h5">Name :</div>
                                <div class="col h5">{{auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name }}</div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-2 h5">Email :</div>
                                <div class="col h5">{{auth()->user()->email}}</div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-2 h5">Phone :</div>
                                <div class="col h5">{{auth()->user()->phone}}</div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-2 h5">Address :</div>
                                <div class="col h5">{{auth()->user()->address}}</div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-2 h5">Role :</div>
                                <div class="col h5">{{auth()->user()->role}}</div>
                            </div>

                            <a href="{{route('change#password#page')}}" class="btn btn-dark">Change Password</a>
                            <a href="{{route('edit#Profile')}}" class="btn btn-primary"> Edit Profile</a>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
