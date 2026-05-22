<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = [
            [
                'invoice' => 'INV001',
                'customer' => 'Surya',
                'total' => 500000
            ]
        ];

        return response()->json($transactions);
    }
    public function summary()
    {
        $transactions = [
            [
                'invoice' => 'INV001',
                'customer' => 'Andi',
                'total' => 500000
            ],
            [
                'invoice' => 'INV002',
                'customer' => 'Budi',
                'total' => 300000
            ],
            [
                'invoice' => 'INV003',
                'customer' => 'Sinta',
                'total' => 700000
            ],
            [
                'invoice' => 'INV004',
                'customer' => 'Surya',
                'total' => 500000
            ]
        ];

        $totalTransaction = count($transactions);

        $totalNominal = 0;

        foreach ($transactions as $transaction) {
            $totalNominal += $transaction['total'];
        }

        $average = $totalNominal / $totalTransaction;

        return response()->json([
            'total_transaction' => $totalTransaction,
            'total_nominal' => $totalNominal,
            'average_transaction' => $average
        ]);
    }
    public function customer(string $name)
    {
    $transactions = [
        [
            'invoice' => 'INV001',
            'customer' => 'Andi',
            'total' => 500000
        ],
        [
            'invoice' => 'INV002',
            'customer' => 'Budi',
            'total' => 300000
        ],
        [
            'invoice' => 'INV003',
            'customer' => 'Andi',
            'total' => 700000
        ]
    ];

    $result = [];

    foreach ($transactions as $transaction) {
        if (strtolower($transaction['customer']) == strtolower($name)) {
            $result[] = $transaction;
        }
    }

    return response()->json($result);
}
}