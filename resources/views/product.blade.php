@extends('master')

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $item)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="/productima/{{ $item->id }}"><img
                                        style="max-height: 350px! important;min-height:350px!important"
                                        src="{{ asset($item->imagepath) }}" alt=""></a>
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p class="product-price"><span>{{ $item->quantity }} </span>{{ $item->price }} $ </p>

                            <a href="/addproducttocart/{{ $item->id }}" class="cart-btn">
                                <i class="fas fa-shopping-cart"></i>
                                اضافة الى السلة
                            </a>


                            @if (Auth::user() && Auth::user()->role == 'admin')
                                <p class="mt-5">
                                    <a href="/removeproduct/{{ $item->id }}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                        حذف المنتج
                                    </a>

                                    <a href="/editproduct/{{ $item->id }}" class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                        تعديل المنتج
                                    </a>

                                    
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach




            </div>
            <style>
                svg {
                    height: 50px !important;
                }

                .center-content {
                    text-align: center;
                }
            </style>
            <div class="center-content">
                {{ $products->links() }}
            </div>

        </div>
    </div>.

    </style>
@endsection
