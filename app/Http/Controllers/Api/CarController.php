<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $vacancy = $request->user()->vacancy;
        $ClassFilter = $request->query('ComfortClass');
        $markFilter = $request->query('markFilter');
        $ComfortClases = $vacancy->comfortClasses;
        $request->validate([
            'time' => ['required'],
        ]);
        $requestTime = $request->time;

        $cars = [];

        foreach ($ComfortClases as $ComfortClass) {
            $query = $ComfortClass->cars();

        if ($markFilter) {
            $query->where('mark', $markFilter);
        }

        $availableCars = $query->get()->filter(function ($car) use ($requestTime) {
            $isBooked = $car->requests()->where(function ($query) use ($requestTime) {
                $query->where('Booking_time_start', '<=', $requestTime)
                      ->where('Booking_time_end', '>=', $requestTime);
            })->exists();

            return !$isBooked;
        });

        $cars[$ComfortClass->name] = $availableCars;
        }

        if (is_null($ClassFilter)) {
            return response()->json($cars);
        } else {
            if (array_key_exists($ClassFilter, $cars)) {
                return response()->json($cars[$ClassFilter]);
            } else {
                return response()->json([
                    'error' => 'Requested comfort class not found',
                    'available_classes' => array_keys($cars)
                ], 404);
            }
        }

    }
}
