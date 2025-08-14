<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $vacancy = $request->user()->vacancy;
        $ComfortClases = $vacancy->comfortClasses;
        $cars = [];
        foreach($ComfortClases as $ComfortClass){
            $cars[$ComfortClass->name] = $ComfortClass->cars;
        }

        return response()->json($cars);
    }
}
