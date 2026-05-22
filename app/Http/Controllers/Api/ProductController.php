<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'stock' => 20,
                'price' => 12000000
            ],
            [
                'id' => 2,
                'name' => 'Keyboard',
                'stock' => 15,
                'price' => 350000
            ]
        ];

        return response()->json($products);
    }
    public function show(string $id)
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'price' => 12000000,
                'stock' => 10
            ],
            [
                'id' => 2,
                'name' => 'Mouse',
                'price' => 150000,
                'stock' => 40
            ],
            [
                'id' => 3,
                'name' => 'Keyboard',
                'price' => 350000,
                'stock' => 15
            ]
        ];

        foreach ($products as $product) {
            if ($product['id'] == $id) {
                return response()->json($product);
            }
        }

        return response()->json([
            'message' => 'Product not found'
        ], 404);
    }
    public function search(Request $request)
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'price' => 12000000,
                'stock' => 10
            ],
            [
                'id' => 2,
                'name' => 'Mouse',
                'price' => 150000,
                'stock' => 40
            ],
            [
                'id' => 3,
                'name' => 'Keyboard',
                'price' => 350000,
                'stock' => 15
            ]
        ];

        $keyword = strtolower($request->name);

        $result = [];

        foreach ($products as $product) {
            if (strtolower($product['name']) == $keyword) {
                $result[] = $product;
            }
        }

        return response()->json($result);
    }
    public function filterstock(Request $request)
    {
        $products = [
            [
                'id'=> 1,
                'name'=> 'Laptop',
                'price'=> 12000000,
                'stock'=> 50
            ],
            [
                'id'=> 2,
                'name'=> 'Mouse',
                'price'=> 250000,
                'stock'=> 10
            ],
            [
                'id'=> 1,
                'name'=> 'Keyboard',
                'price'=> 500000,
                'stock'=> 30
            ],
            [
                'id'=> 1,
                'name'=> 'Webcam',
                'price'=> 300000,
                'stock'=> 20
            ],
        ];

        $stock = $request->stock;

        $result = [];

        foreach ($products as $product){
            if($product['stock'] > $stock){
                $result[] = $product;
            }
        }
        return response()->json($result);
    }
    public function category(string $category, Request $request)
{
    $products = [
        [
            'id' => 1,
            'name' => 'Laptop',
            'category' => 'electronic',
            'price' => 12000000
        ],
        [
            'id' => 2,
            'name' => 'Mouse',
            'category' => 'electronic',
            'price' => 150000
        ],
        [
            'id' => 3,
            'name' => 'Book',
            'category' => 'education',
            'price' => 80000
        ]
    ];

    $minPrice = $request->min_price;

    $result = [];

    foreach ($products as $product) {
        if (
            strtolower($product['category']) == strtolower($category)
            &&
            $product['price'] >= $minPrice
        ) {
            $result[] = $product;
        }
    }

    return response()->json($result);
}
    public function maxPrice()
{
    $products = [
        [
            'id' => 1,
            'name' => 'Laptop',
            'price' => 12000000
        ],
        [
            'id' => 2,
            'name' => 'Mouse',
            'price' => 150000
        ],
        [
            'id' => 3,
            'name' => 'Keyboard',
            'price' => 350000
        ]
    ];

    $maxProduct = $products[0];

    foreach ($products as $product) {
        if ($product['price'] > $maxProduct['price']) {
            $maxProduct = $product;
        }
    }

    return response()->json($maxProduct);
}
    public function minStock()
{
    $products = [
        [
            'id' => 1,
            'name' => 'Laptop',
            'stock' => 10
        ],
        [
            'id' => 2,
            'name' => 'Mouse',
            'stock' => 40
        ],
        [
            'id' => 3,
            'name' => 'Keyboard',
            'stock' => 5
        ]
    ];

    $minProduct = $products[0];

    foreach ($products as $product) {
        if ($product['stock'] < $minProduct['stock']) {
            $minProduct = $product;
        }
    }

    return response()->json($minProduct);
}
}