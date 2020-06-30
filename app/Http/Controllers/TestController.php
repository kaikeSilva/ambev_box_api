<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{

    public function index(Request $request) {
        return Test::all()->pluck('message');
    }
}
