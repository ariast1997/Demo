@extends('admin.layout.master')

@section('content')

<div class="container-fluid">

    <div class=" d-flex justify-content-between my-2">
        <a href="{{route('user#list')}}" class="btn btn-dark btn-sm text white mb-2 shadow-sm">Order List</a>
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
                    <th>Date</th>
                    <th>Order Code</th>
                    <th>User Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                    <tr>
                        <input type="hidden" value="{{$item->order_code}}" class="orderCode">
                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                        <td><a href="{{route('order#details',$item->order_code)}}">{{$item->order_code}}</a></td>z
                        <td>{{$item->user_name}}</td>
                        <td>
                            <select name="" id="" class="form-select statusChange">
                                <option value="0" @if($item->status == 0) selected @endif>Pending</option>
                                <option value="1" @if($item->status == 1) selected @endif>Accept</option>
                                <option value="2" @if($item->status == 2) selected @endif>Reject</option>
                            </select>
                        </td>
                        <td>
                            @if($item->status == 0)<span><i class="fa-solid fa-hourglass-half text-warning"></i></i></i></span>@endif
                            @if($item->status == 1)<span><i class="fa-solid fa-check text-success"></i></span>@endif
                            @if($item->status == 2)<span><i class="fa-regular fa-circle-xmark text-danger"></i></span>@endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section ('scriptSource')
    <script>
        $(document).ready(function (){
            $('.statusChange').change(function(){
                $changeStatus = $(this).val();
                $orderCode = $(this).parents("tr").find('.orderCode' ).val();

                $data= {
                    'order_code' : $orderCode ,
                    'status' : $changeStatus,
                };

                $.ajax({
                    type : 'get' ,
                    url : '/admin/order/changeStatus',
                    data : $data,
                    dataType : 'json',
                    success:function(res){
                        res.status == 'success' ? location.reload() : ''
                    }
                })
            })
        })
    </script>
@endsection
