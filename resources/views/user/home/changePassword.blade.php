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
                                    <form action="{{ route('change#password') }}" method="POST" class="p-3 rounded">
                                        @csrf
                                        <div class="col-6 offset-3 mt-2">
                                            <!-- Page Heading -->
                                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-lable">Old Password</label>
                                            <input type="text" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" id="" placeholder="Enter Old Password">
                                            @error('oldPassword')
                                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-lable">New Password</label>
                                            <input type="text" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" id="" placeholder="Enter New Password">
                                            @error('newPassword')
                                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-lable">Confirm New Password</label>
                                            <input type="text" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" id="" placeholder=" Confirm New Password">
                                            @error('confirmPassword')
                                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <input type="submit" class="btn btn-primary" id="" value="Change">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </div>

@endsection
