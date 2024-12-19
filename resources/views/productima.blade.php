@extends('master')
@section('content')

                
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-img">
                    <img src="{{ asset($product->imagepath) }}"  alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3>{{ ($product->name  ) }}</h3>
                    <p>القسم: {{$product->Category->name}}</p>
                    <p class="single-product-pricing"><span>الكمية {{ ($product->quantity) }}</span> ${{ ($product->price) }}</p>
                    <p>{{ ($product->description) }}</p>
                    <div class="single-product-form">
                       
                        <a href="/addproducttocart/{{$product->id}}"  class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        <p><strong>Categories: </strong>Fruits, Organic</p>
                    </div>
                    <h4>Share:</h4>
                    <ul class="product-share">
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                        <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end single product -->
<div class="more-products mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">	
                    <h3><span class="orange-text">Related</span> Products</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>
        <div class="row">
        
        
         
            <div class="testimonail-section mt-80 mb-150">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 text-center">
                            <div class="testimonial-sliders">

                                @foreach ($product ->productphoto as $item)
                                    <div class="single-testimonial-slider">
                                        <div class="client-avater">
                                            <img style="width: 25%; height:250%;max-width:none !important;border-radius:20px !important" src="{{asset($item->imagepath)}}" alt="">
                                        </div>
                                        <div class="client-meta">
                                            <p class="testimonial-body">
                                            <div class="last-icon">
                                                <i class="fas fa-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

        
            </div>
        
            </div>
         
            </div>
        </div>
    </div>
</div>


@endsection