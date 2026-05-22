<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $products = [
            [
                'name' => 'Laptop',
                'stock' => 20
            ],
            [
                'name' => 'Mouse',
                'stock' => 50
            ]
        ];

        $transactions = [
            [
                'invoice' => 'INV001',
                'customer' => 'Andi',
                'total' => 500000
            ]
        ];

        return view('dashboard', compact('products', 'transactions'));
    }
}