@extends('master')
@section('content')

<div class="product-section mt-150 mb-150">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="product-filters">
                    <ul>
                       
                        @foreach ($categories as $item)
                        <li data-filter="._{{$item->id}}">{{$item->name}}</li>
                            
                        @endforeach
                        <li class="active" data-filter="*">الكل</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row product-lists">
            @foreach ($products as $item)
            <div class="col-lg-4 col-md-6 text-center _{{$item->category_id}}">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="/productima/{{ $item->id }}">
                        <img style="max-height: 250px! important;min-height:250px!important" src="{{asset($item->imagepath)}}" alt=""></a>
                    </div>
                    <h3>{{$item->name}}</h3>
                    <p class="product-price"><span>price</span> {{$item->price}} </p>
                    <p class="product-price"><span>quantity</span> {{$item->quantity}} </p>


                    
                    <a href="/addproducttocart/{{$item->id}}" class="cart-btn"
                        >
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

        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="pagination-wrap">
                    <ul>
                        <li><a href="#">Prev</a></li>
                        <li><a href="#">1</a></li>
                        <li><a class="active" href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



    
@endsection