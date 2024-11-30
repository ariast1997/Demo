@extends ('admin.layout.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <a href="" class=" text-black m-3"> <i class="fa-solid fa-arrow-left-long"></i> Back</a>
        {{-- DataTales Example --}}
        <div class=" row">
            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Name : </div>
                        <div class="col-7">{{ $payslipData->user_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Phone :</div>
                        <div class="col-7">{{ $payslipData->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Code : </div>
                        <div class="col-7" id="orderCode">{{ $payslipData->order_code }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">0rder Date :</div>
                        <div class="col-7" >{{ $order[0]->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Total Price :</div>
                        <div class="col-7">
                            {{ $payslipData->total_amt }}<br> <br>
                            <small class=" text-danger ms-1">(Contain Delivery Charges )</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Contact Phone : </div>
                        <div class="col-7">{{ $payslipData->phone }}</div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-5">Payment Method :</div>
                        <div class="col-7">{{ $payslipData->payment_method }}</div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-5">Purchased Date :</div>
                        <div class="col-7">{{ $payslipData->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <img style="width: 150px" src="{{ asset('payslip/' . $payslipData->payslip_image) }}"
                            class="img-thumbnail">
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">Order Board</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="productTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="col-2">Image</th>
                                    <th>Name</th>
                                    <th>Count</th>
                                    <th>Available Stock</th>
                                    <th>Product Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                    <tr>
                                        <input type="hidden" value="{{ $item->product_id }}" class="productId">
                                        <input type="hidden" class="productOrderCount" value="{{ $item->order_count }}">
                                        <td>
                                            <img style="width: 100px" src="{{ asset('product/'.$item->product_image) }}"
                                                class=" img-thumbnail">
                                        </td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->order_count }} @if ($item->available_stock < $item->order_count)
                                                (<span class="text-danger">(only left{{ $item->available_stock }})</span>)
                                            @endif
                                        </td>
                                        <td>{{ $item->available_stock }}</td>
                                        <td>{{ $item->product_price }} MMK</td>
                                        <td>{{ $item->order_count * $item->product_price }}MMK</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <div class="">
                            <input type="button" @if(!$status) disabled @endif id="btn-order-confirm" class=" btn btn-success rounded shadow-sm"
                            value="Confirm ">

                            <input type="button" id="btn-order-reject" class="btn btn-danger rounded shadow-sm"
                            value="Reject">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- .container-fluid --}}
    @endsection

    @section('scriptSource')
        <script>
            $(document).ready(function() {
                $('#btn-order-confirm').click(function() {
                    $orderList = [];
                    $orderCode = $('#orderCode').text();

                    $('#productTable tbody tr').each(function(index, row) {
                        $productId = $(row).find(".productId").val();
                        $productOrderCount = $(row).find(".productOrderCount").val();


                        $orderList.push({
                            'product_id': $productId,
                            'order_count': $productOrderCount,
                            'order_code': $orderCode,
                        })
                    })

                    $.ajax({
                        type : 'get',
                        url : '/admin/order/confirmOrder',
                        data : Object.assign({},$orderList),
                        dataType : 'json',
                        success: function (res) {
                            res.status = 'success' ? location.href = '/admin/order/list' : ''
                        }
                    })

                })
            })

            $('#btn-order-reject').click(function() {

                    $data = {
                        'orderCode' : $('#orderCode').text()
                    }

                    $.ajax({
                        type : 'get',
                        url : '/admin/order/rejectOrder',
                        data : $data,
                        dataType : 'json',
                        success: function (res) {
                            res.status = 'success' ? location.href = '/admin/order/list' : ''
                        }
                    })

                })
        </script>
    @endsection
