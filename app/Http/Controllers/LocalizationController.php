<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
class LocalizationController extends Controller
{
    public function SetLocale($locale)
    {
        session()->put('locale',$locale);
        return redirect()->back(); // Redirect back to the previous page
    }
}
