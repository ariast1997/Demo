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
                <div class="card-title d-flex justify-content-center bg-primary text-white">Edit Products</div>
                <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="oldPhoto" id="" value="{{$products->image}}">
                    <input type="hidden" name="productId" id="" value="{{$products->id}}">

                    <div class="card-body">
                        <div class="mb-3">
                            {{-- <input type="hidden" name="oldImage" id=""> --}}

                            <img src="{{asset('product/'.$products->image)}}" width="100" alt="" class="img -profile img -thumbnail" id="output">

                            <input type="file" name="image" id=""
                                class="form-control mt-3 @error('image') is-invalid @enderror" onchange="loadFile(event)">
                            @error('image')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-lable">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Enter name..." value="{{old('name',$products->name)}}">
                            @error('name')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-lable">Category Name</label>
                            <select name="categoryId" id="" class="form-control @error('categoryId') is-invalid @enderror" >
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}" @if(old('categoryId',$products->category_id)  == $item->id) selected @endif >{{$item->name}}</option>
                                @endforeach
                            </select>

                            @error('categoryId')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-lable">Price</label>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="" placeholder="Enter price..." value="{{old('price',$products->price)}}">
                                    @error('price')
                                        <small class="text-danger invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-lable">Stock</label>
                                    <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" id="" placeholder="Enter stock..." value="{{old('stock',$products->stock)}}">
                                    @error('stock')
                                        <small class="text-danger invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-lable">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" id="" placeholder="Enter Description ...">{{old('description',$products->description)}}</textarea>
                            @error('description')
                                <small class="text-danger invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <input type="submit" name="" id="" value="Update Product" class="btn btn-primary w-100 ">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
