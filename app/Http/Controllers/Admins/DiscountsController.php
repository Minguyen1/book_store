<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    public function index(){
        return view('admins.discounts.index');
    }

    public function create(){
        return view('admins.discounts.create');
    }
}
