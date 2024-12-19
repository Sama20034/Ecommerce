@extends('dashboard.master')
@section('content')

    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">تعديل</span> المنتج</h3>
                    </div>
                </div>
            </div>





            <div class="col-lg-12 mb-5 mb-lg-0">
                <div class="form-title">
                </div>
                <div id="form_status"></div>
                <div class="contact-form">
                    <form method="POST" action="/storeproduct" enctype="multipart/form-data" style="text-align: right" dir="rtl">
                        @csrf()
                        <p>
                            <input type="hidden" style="width: 100%" required placeholder="" name="id"
                                id="id" value="{{ $product->id }}">
                            <input type="text" style="width: 100%" required placeholder="الاسم" name="name"
                                id="name" value="{{ $product->name }}">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </p>
                        <p style="display:flex">
                            <input type="number" style="width: 50%" class="ml-4" required placeholder="السعر"
                                name="price" value="{{ $product->price }}" id="price">

                            <span class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input type="number" required style="width: 50%" placeholder="الكمية" name="quantity"
                                value="{{ $product->quantity }}" id="quantity">

                            <span class="text-danger">
                                @error('quantity')
                                    {{ $message }}
                                @enderror
                            </span>
                        </p>
                        <p>
                            <textarea name="description" required id="description" cols="30" rows="10" value="{{ $product->description }}"
                                placeholder="النص"></textarea>
                        </p>
                        <span class="text-danger">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </span>

                        <p>
                            <select class="form-control" required name="category_id">

                                @foreach ($allcategories as $item)
                                    @if ($item->id == $product->category_id)
                                        <option value="{{ $item->id }}" selected> {{ $item->name }} </option>
                                    @else
                                        <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                    @endif
                                @endforeach

                            </select>
                            <span class="text-danger">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </p>
                        <p>

                            <input type="file" style="width: 100%" required placeholder="تغير الصورة" name="imagepath"
                                id="imagepath" value="{{ $product->imagepath }}">
                            <span class="text-danger">
                                @error('imagepath')
                                    {{ $message }}
                                @enderror
                            </span>
                            <img src="{{ asset($product->imagepath) }}" width="200" height="200" />
                        </p>


                        <p><input type="submit" value="حفظ"></p>
                    </form>
                </div>
            </div>
        @endsection
