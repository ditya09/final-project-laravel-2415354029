<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            [
                'id' => 1,
                'name' => 'Andi',
                'city' => 'Denpasar'
            ],
            [
                'id' => 2,
                'name' => 'Sinta',
                'city' => 'Bandung'
            ]
        ];

        return response()->json($customers);
    }
    public function city(string $city)
    {
        $customers = [
            [
                'id' => 1,
                'name' => 'Andi',
                'city' => 'Denpasar'
            ],
            [
                'id' => 2,
                'name' => 'Sinta',
                'city' => 'Bandung'
            ],
            [
                'id' => 3,
                'name' => 'Budi',
                'city' => 'Jakarta'
            ]
        ];

        $result = [];

        foreach ($customers as $customer) {
            if (strtolower($customer['city']) == strtolower($city)) {
                $result[] = $customer;
            }
        }

        return response()->json($result);
    }
    public function search(Request $request)
{
    $customers = [
        [
            'id' => 1,
            'name' => 'Andi',
            'city' => 'Denpasar'
        ],
        [
            'id' => 2,
            'name' => 'Sinta',
            'city' => 'Bandung'
        ],
        [
            'id' => 3,
            'name' => 'Budi',
            'city' => 'Jakarta'
        ]
    ];

    $city = strtolower($request->city);

    $result = [];

    foreach ($customers as $customer) {
        if (strtolower($customer['city']) == $city) {
            $result[] = $customer;
        }
    }

    return response()->json($result);
}
}