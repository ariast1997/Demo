@extends('admin.layout.master')

@section('content')

<div class="container-fluid">
    <div class=" d-flex justify-content-center">
        <h1>Product List</h1>
    </div>
    <div class="d-flex justify-content-between mb-2">
        <div>
            <button class="btn btn-secondary shadow-sm rounded"><i class="fa-solid fa-database"></i> Product Count {{count($product)}}</button>
            <a href="{{route('product#list')}}" class="btn btn-primary">All</a>
            <a href="{{route('product#list','amt')}}" class="btn btn-danger">Low stocks</a>
        </div>
        <div class=" ">
            <form action="{{route('product#list')}}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" name="searchKey" value="{{request('searchKey')}}" id=""
                    placeholder="Search..." >
                    <button class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">

                <thead class="">
                  <tr class="bg-primary text-white">

                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @if (count($product) != 0)
                        @foreach ($product as $item)
                        <tr>

                            <td class="col-1"><img src="{{asset('product/'.$item->image)}}" class="w-100 img-thumbnail rounded shadow-sm " alt=""></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}} MMK</td>
                            <td>
                                <button type="button" class="btn btn-primary position-relative">
                                    {{$item->stock}}
                                    @if ($item->stock <= 5)
                                     <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        only left
                                    @endif


                                    </span>
                                  </button>
                            </td>
                            <td>{{$item->category_name}}</td>
                            <td>
                                <a href="{{ route('update#page',$item->id) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="{{ route('product#delete',$item->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                <a href="{{ route('product#detail',$item->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-circle-info"></i></i></a>

                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>There is no prodicts</td>
                        </tr>
                    @endif

                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
