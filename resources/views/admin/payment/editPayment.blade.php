@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit Payment</div>
                    <div class="card-body bg-dark">
                        <div class="">
                            <form action="{{route('update#payment')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" id="" value="{{$payment->id}}">

                                <div class="mb-2">
                                    <label for="" class="text-white">Banking Number</label>
                                    <input type="text" name="number" id="" placeholder="Enter Banking Number..." class="form-control @error('number') is-invalid @enderror" value="{{old('number',$payment->account_number)}}">
                                </div>
                                @error('number')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="mb-2">
                                    <label for="" class="text-white">Name</label>
                                    <input type="text" name="name" id="" placeholder="Enter Banking Name..." class="form-control @error('name') is-invalid @enderror" value="{{old('name',$payment->account_name)}}">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="mb-2">
                                    <label for="" class="text-white">Banking Type</label>
                                    <input type="text" name="type" id="" placeholder="Enter Banking Type..." class="form-control @error('type') is-invalid @enderror" value="{{old('type',$payment->type)}}">
                                </div>
                                @error('type')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="mt-3">
                                    <input type="submit" name="" id="" value="Create" class="btn btn-primary">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
