<?php

namespace App\Http\Controllers;
use App\Models\Reviews;
use App\Models\category;
use Illuminate\Http\Request;


class Review extends Controller
{
    public function storeReview(Request $request)
    {
  
  
      $request->validate([
        'name' => ['required', 'max:100'],
        'phone' => 'required',
        'email' => 'required',
        'subject' => 'required',
        'message' => 'required'
      ]);
      $newReviews = new Reviews();
      $newReviews->name = $request->name;
      $newReviews->phone = $request->phone;
      $newReviews->email = $request->email;
      $newReviews->subject = $request->subject;
      $newReviews->message = $request->message;
      $newReviews->save();
  
  
      return redirect('/');
    }
    public function Reviews()
    {
  
  
      $Reviews = Reviews::all();
  
      return view('reviews', ['Reviews' => $Reviews]);
    }
  
}
