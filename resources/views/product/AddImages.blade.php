@extends('master')

@section('content')

                


<div class="container mt-4 mb-4" style="text-align:center">
    

        <form method="POST" action="/storeproductimage" enctype="multipart/form-data" style="text-align: right" dir="rtl">
            <div class="row mt-5 mb-5">
            @csrf()
         
            <input type="hidden" name="product_id"  id="product_id" value="{{$product->id}}">
        

        <div class="col-9 pt-3">
            <input type="file" placeholder="اضف صورة للمتج" class="form-control"  class="col-12" name="imagepath"> 
            </div>

            <div class="col-2">
                <input type="submit" class="w-100"  value="حفظ">
            </div>
                <span class="text-danger">
                    @error('imagepath')
                        {{ $message }}
                    @enderror
                </span>
           
        </form>


    </div>

    <div class="row">
    @foreach ($productImages as $item)

    <div class="col-4">
                <img class="m-2" src="{{ asset($item->imagepath) }}" width="250px" height="250px" alt=""></a>
                    
             
                    <a href="/removeproductimage/{{ $item->id }}" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        حذف الصورة
                    </a>
    </div>
        @endforeach
    </div>

    </div>















@endsection