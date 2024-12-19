@extends('aaa')

@section('content')


<div class="container">
    <!-- العنوان: آراء العملاء -->
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="section-title">
                <h3><span class="orange-text">Customer</span> Opinions</h3>
            </div>
        </div>
    </div>

    <!-- النموذج -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact-form">
                <form method="post" action="/storeReview" style="text-align: right" dir="rtl">
                    @csrf()
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" required placeholder="Name" name="name" id="name" value="{{ old('name') }}">
                                <span class='text-danger'>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <input type="email" required placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                                <span class='text-danger'>
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="tel" required placeholder="Phone" name="phone" id="phone" value="{{ old('phone') }}">
                                <span class='text-danger'>
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <input type="text" required placeholder="Subject" name="subject" id="subject" value="{{ old('subject') }}">
                                <span class='text-danger'>
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea required name="message" id="message" cols="30" rows="10" placeholder="Message">{{ old('message') }}</textarea>
                        <span class='text-danger'>
                            @error('message')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <input type="hidden" name="token" value="FsWga4&@f6aw" />

                    <div class="form-group">
                        <input type="Submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CSS لتنسيق العرض -->
<style>
    .container {
        margin-top: 30px;
    }

    /* تنسيق الحقول */
    .form-group {
        margin-bottom: 20px;
    }

    /* تنسيق الحقول داخل صفوف */
    .row {
        margin-bottom: 10px;
    }

    .col-md-6 {
        padding: 0 15px;
    }

    input[type="text"], input[type="email"], input[type="tel"], input[type="submit"], textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 16px;
    }

    textarea {
        resize: vertical;
    }

    /* تنسيق زر الإرسال */
    input[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        padding: 12px 20px;
        border-radius: 5px;
    }

    input[type="submit"]:hover {
        background-color: #ff6600;
    }

    /* تنسيق الحقول مع الأخطاء */
    .text-danger {
        font-size: 12px;
        color: red;
    }
</style>




                        <div class="testimonail-section mt-80 mb-150">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1 text-center">
                                        <div class="testimonial-sliders">
                                            @foreach ($Reviews as $item)
                                                <div class="single-testimonial-slider">
                                                    <div class="client-avater">
                                                        <img src="assets/img/avaters/avatar1.png" alt="">
                                                    </div>
                                                    <div class="client-meta">
                                                        <h3>{{ $item->name }}<span>{{ $item->subject }} </span></h3>
                                                        <p class="testimonial-body">
                                                            {{ $item->message }}
                                                        </p>
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
                    @endsection