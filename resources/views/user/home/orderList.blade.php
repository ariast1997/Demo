@extends ('user.layout.master')

@section('content')
<div class="container " style="margin-top: 150px">
    <div class="row">
       <div class="col">
        <table class="table">
            <div class="tabel-header d-flex justify-content-center">
                <h1>Admin List</h1>
            </div>
            <thead class="">
              <tr class="bg-primary text-white">
                <th scope="col">Order Code</th>
                <th scope="col">Date</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Order Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach($order as $item)
                  <tr>
                    <td>{{$item['order_code']}}</td>
                    <td>{{$item['created_at']}}</td>
                    <td>
                      @if($item['status'] == 0)
                          <span class="btn btn-warning btn-sm rounted shadow-sm">Pending</span>
                      @elseif ($item['status'] == 1)
                        <span class="btn btn-success btn-sm rounted shadow-sm">Success</span>
                      @else
                         <span class="btn btn-danger btn-sm rounted shadow-sm"> Reject</span>
                      @endif
                    <td>
                  </tr>
                @endforeach

            </tbody>
          </table>
       </div>
    </div>
</div>
@endsection
