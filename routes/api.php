<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SubscriptionController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/filter-stock', [ProductController::class, 'filterstock']);
Route::get('/products/category/{category}', [ProductController::class, 'category']);
Route::get('/products/max-price', [ProductController::class, 'maxPrice']);
Route::get('/products/min-stock', [ProductController::class, 'minStock']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/customers/search', [CustomerController::class, 'search']);
Route::get('/customers/city/{city}', [CustomerController::class, 'city']);
Route::get('/transactions/summary', [TransactionController::class, 'summary']);
Route::get('/report/{year}/{month}', [ReportController::class, 'monthly']);
Route::get('/transactions/customer/{name}', [TransactionController::class, 'customer']);

Route::apiResource("services", ServiceController::class);

Route::patch("services/{service}/activate", [
    ServiceController::class,
    "activate",
]);

Route::patch("services/{service}/deactivate", [
    ServiceController::class,
    "deactivate",
]);

Route::apiResource("customers", CustomerController::class);

Route::patch("customers/{customer}/activate", [
    CustomerController::class,
    "activate",
]);

Route::patch("customers/{customer}/deactivate", [
    CustomerController::class,
    "deactivate",
]);

Route::apiResource("subscriptions", SubscriptionController::class);

Route::patch("subscriptions/{subscription}/activate", [
    SubscriptionController::class,
    "activate",
]);

Route::patch("subscriptions/{subscription}/deactivate", [
    SubscriptionController::class,
    "deactivate",
]);
