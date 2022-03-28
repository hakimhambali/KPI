<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FindOwnerController extends Controller
{
    public function index() {
        // call apis

        $test = Http::get("http://findowner.x61tbrxchx-ewx3lmoq56zq.p.runcloud.link/api/car/all");

        return $test;
    }
}