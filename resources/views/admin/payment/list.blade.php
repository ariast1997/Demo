@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card rounded">
                    <div class="card-header bg-primary text-white">
                        <h5>Add Payments</h5>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="">
                            <form action="{{route('create#payment')}}" method="post">
                                @csrf

                                <div class="mb-2">
                                    <label for="" class="text-white">Banking Number</label>
                                    <input type="text" name="number" id="" placeholder="Enter Banking Number..." class="form-control @error('number') is-invalid @enderror" value="{{old('number')}}">
                                </div>
                                @error('number')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="mb-2">
                                    <label for="" class="text-white">Name</label>
                                    <input type="text" name="name" id="" placeholder="Enter Banking Name..." class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                <div class="mb-2">
                                    <label for="" class="text-white">Banking Type</label>
                                    <input type="text" name="type" id="" placeholder="Enter Banking Type..." class="form-control @error('type') is-invalid @enderror" value="{{old('type')}}">
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
            <div class="col">
                <div class="">
                    <table class="table">
                        <thead class="">
                          <tr class="bg-primary text-white">
                            <th scope="col">#</th>
                            <th scope="col">Payment Number</th>
                            <th scope="col">Payment Name</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment as $item)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$item->account_number}}</td>
                                <td>{{$item->account_name}}</td>
                                <td>{{$item->type}}</td>
                                <td>
                                    <a href="{{route('edit#payment',$item->id)}}" class="btn btn-sm btn-outline-primary md-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="{{route('delete#payment',$item->id)}}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></i></a>
                                </td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
