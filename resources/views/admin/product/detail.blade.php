@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="card m-2 shadow-sm col-4 m-2">
            <img src="{{asset('product/'.$data->image)}}" alt="" class="img-thumbnail rounded shadow-sm w-100" >

            <div class="">
                <div class="card-body">
                    <h4>Brand - {{$data->name}}</h4>
                    <p class="btn btn-primary">{{$data->price}} - MMK</p>
                    <p class="btn btn-danger">Stock left - {{$data->stock}}</p>
                    <p class="btn btn-dark">Category - {{$data->category_name}}</p>
                </div>
            </div>
        </div>

    </div>
@endsection
