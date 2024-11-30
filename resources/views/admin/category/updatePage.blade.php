@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category list</h1>
        </div>

        <div class="">
            <div class="row">
                <div class="col-4">
                    <a href="{{route('list')}}" class="btn btn-sm btn-primary mb-3">back</a>

                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('category#update',$categories->id)}}" method="post" class="p-3 rounded">
                                @csrf
                                 <input type="text" name="categoryName" id="" value="{{old('categoryName',$categories->name)}}" class="form-control @error('categoryName') is-invalid @enderror" placeholder="Enter Category Name">
                                 @error('categoryName')
                                    <small class="invalid-feedback">{{$message}}</small">
                                  @enderror
                                   <br>

                                <input type="submit" name="" id="" value="Update" class="btn btn-primary mt-2">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
