@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">

        <div class=" d-flex justify-content-between my-2">
            <a href="{{route('admin#list')}}" class="btn btn-danger btn-sm text white mb-2 shadow-sm">Admin</a>
            <div class=" ">
                <form action="{{route('admin#list')}}" method="GET">
                    <div class="input-group">
                        <input type="text" name="searchKey" id="" placeholder="Search...">
                        <button class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <div class="table-header d-flex justify-content-center">
                        <h1>User Lists</h1>
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
                        @foreach ($users as $item)
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

                            {{-- delete button  --}}
                            @if ($item->role != 'superadmin')
                                <td><a href="{{ route('delete#user',$item->id)}}" class="btn btn-outline-danger btn-sm shadow"><i class="fa-solid fa-trash"></i></a></td>
                            @endif

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
