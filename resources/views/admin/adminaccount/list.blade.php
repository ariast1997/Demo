@extends('admin.layout.master')

@section('content')

<div class="container-fluid">

    <div class=" d-flex justify-content-between my-2">
        <a href="{{route('user#list')}}" class="btn btn-dark btn-sm text white mb-2 shadow-sm">User</a>
        <div class="form ">
            <form action="" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="searchKey" id="" placeholder="Search..." value="{{request('searchKey')}}">
                    <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <div class="tabel-header d-flex justify-content-center">
                    <h1>Admin List</h1>
                </div>
                <thead class="">
                  <tr class="bg-primary text-white">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Role</th>
                    <th scope="col">Provider</th>
                    <th scope="col">Created Date</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->role}}</td>
                        <td>
                            @if( $item->provider == 'google') <i class="fa-brands fa-google"></i>@endif
                            @if( $item->provider == 'github') <i class="fa-brands fa-github"></i>@endif
                            @if( $item->provider == 'simple') <i class="fa-solid fa-right-to-bracket"></i>@endif

                        </td>
                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                        @if ($item->role != 'superadmin')
                            <td><a href="{{ route('delete#admin',$item->id)}}" class="btn btn-outline-danger btn-sm shadow"><i class="fa-solid fa-trash"></i></a></td>
                        @endif

                      </tr>
                    @endforeach

                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
