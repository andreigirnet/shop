<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExlpodeController extends Controller
{
    public function explode(){
        $array = ['Andrei=>123','Ion=>123','John=>123'];
        $arrayI = implode(',',$array);
        $finalResult= explode(',', $arrayI);
        dd($finalResult);
        return view('explode', compact('finalResult'));
    }
}
