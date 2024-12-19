@extends('master')

@section('content')
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartProducts as $item)
                                    <tr class="table-body-row">
                                        <td class="product-remove"><a href="/removecart/{{ $item->id }}"><i class="far fa-window-close"></i></a>
                                        </td>
                                        <td class="product-image"><img src="{{ asset($item->product->imagepath) }}"
                                                alt=""></td>
                                        <td class="product-name">
                                            <a href="/productima/{{$item->product->id}}">
                                            {{$item->product->name}}</td>
                                            </a>
                                        <td class="product-price">{{$item->product->price}}$</td>
                                        <td class="product-quantity">{{$item ->quantity}}</td>
                                        <td class="product-total">{{$item->product->price*$item->quantity}}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>${{ $totalPrice }}</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>${{ $totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a href="/completeorder" class="boxed-btn black">Check Out</a>
                       
                            <a href="/Previouseorder" class="boxed-btn black">All order</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
