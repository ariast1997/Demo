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
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('category#create') }}" method="post" class="p-3 rounded">
                                @csrf


                                 <input type="text" name="categoryName" id="" class="form-control @error('categoryName') is-invalid @enderror" placeholder="Category Name">
                                 @error('categoryName')
                                    <small class="invalid-feedback">{{$message}}</small">
                                  @enderror
                                   <br>

                                <input type="submit" name="" id="" value="Create" class="btn btn-primary mt-2">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <table class="table">
                        <thead>
                          <tr class="bg-primary text-white">
                            <th >Name</th>
                            <th >created_at</th>
                            <th >updated_at</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{ route('Cat#updatePage',$item->id) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="{{ route('category#delete',$item->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                              </tr>
                            @endforeach



                        </tbody>
                      </table>
                      <span>{{$categories->links()}}</span>
                </div>

            </div>
        </div>

    </div>

@endsection
