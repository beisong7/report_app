<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Phone;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){

        $phones = Phone::orderBy('opened', 'desc')->take(20)->get();
        $emails = Email::orderBy('opened', 'desc')->take(20)->get();
        $week_starts = date('Y/m/d', strtotime("sunday -1 week"));
        $week_ends = date('Y/m/d', strtotime("sunday 0 week"));

        $week_calls = Phone::where('opened', '>=', $week_starts)->where('opened','<',$week_ends)->select(['id'])->get()->count();
        $week_emails = Email::where('opened', '>=', $week_starts)->where('opened','<',$week_ends)->select(['id'])->get()->count();
//        dd($week_starts);
        return view('home')->with(
            [
                'phones'=>$phones,
                'emails'=>$emails,
                'week_calls'=>$week_calls,
                'week_emails'=>$week_emails,
            ]
        );
    }
}
