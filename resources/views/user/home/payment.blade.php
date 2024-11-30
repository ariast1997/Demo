@extends ( 'user.layout.master')

@section ( 'content')

<div class="container" style="margin-top: 150px">
    <div class=" row">
        <div class="card col-10 offset-1 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <h5 class="mb-5">Payment methods</h5>

                        @foreach($payment as $item)
                            <div class="">
                                {{ $item->type }} ( Name : {{ $item->account_name }} )
                            </div>
                            Account : {{ $item->account_number }}
                            <hr>
                        @endforeach
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                Payment Info
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <form action="{{ route('product#order')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col">
                                                 <input type="text" name="name" readonly value="{{Auth::user()->name}}" id="" class="form-control @error('name') is-invalid @enderror" placeholder="User Name...">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="phone" value="{{old('phone',Auth::user()->phone)}}" id="" class="form-control @error('phone') is-invalid @enderror" placeholder="09XXXXXX">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="address" value="{{old('address',Auth::user()->address)}}" id="" class="form-control @error('address') is-invalid @enderror" placeholder="Address...">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <select name="paymentType" id="" class=" form-select @error('paymentType') is-invalid @enderror">
                                                    <option value="">Choose Payment methods...</option>
                                                    @foreach ($payment as $item)
                                                        <option value="{{$item->type}}" @if(old('paymentType') == $item->type) selected @endif>{{$item->type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="file" name="payslipImage" id="" class="form-control @error('payslipImage') is-invalid @enderror">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-2">
                                                <input type="hidden" name="orderCode" value="{{$orderProduct[0]['order_code']}}">
                                                Order Code: <span class="text-secondary fw-bold">{{$orderProduct[0]['order_code']}}</span>
                                            </div>
                                            <div class="col mt-2">
                                                <input type="hidden" name="totalAmount" value="{{$orderProduct[0]['total_amount']}}">
                                                Total Amount : <span class="text-secondary fw-bold">{{$orderProduct[0]['total_amount']}}</span>
                                            </div>
                                            <div class="row mt-4 mx-2">
                                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-cart-shopping me-3"></i> Order Now...</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
