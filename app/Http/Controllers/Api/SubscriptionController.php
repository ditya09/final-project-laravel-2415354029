<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $status = $request->query("status");
        $search = $request->query("search");

        $query = Subscription::query()
            ->with(["customer", "service"]);

        // filter status
        if ($status !== null) {

            if (
                !in_array(
                    $status,
                    ["active", "inactive", "trial", "isolir", "dismantle"],
                    true
                )
            ) {
                return response()->json([
                    "success" => false,
                    "message" => "Validation failed",
                    "errors" => [
                        "status" => ["The selected status is invalid."],
                    ],
                ], 422);
            }

            $query->where("status", $status);
        }

        // search customer/service
        if ($search !== null) {
            $query->where(function ($q) use ($search) {

                $q->whereHas("customer", function ($customer) use ($search) {
                    $customer->where("name", "like", "%{$search}%");
                })

                ->orWhereHas("service", function ($service) use ($search) {
                    $service->where("name", "like", "%{$search}%");
                });

            });
        }

        $subscriptions = $query->latest()->get();

        return response()->json([
            "success" => true,
            "message" => "Subscriptions retrieved successfully",
            "data" => $subscriptions,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate(
            [
                "customer_id" => [
                    "required",
                    "exists:customers,id"
                ],

                "service_id" => [
                    "required",
                    "exists:services,id"
                ],

                "start_date" => [
                    "required",
                    "date"
                ],

                "end_date" => [
                    "required",
                    "date",
                    "after:start_date"
                ],

                "status" => [
                    "required",
                    "in:active,inactive,trial,isolir,dismantle"
                ],
            ],
            [
                "customer_id.required" => "Customer is required",
                "customer_id.exists" => "Customer not found",

                "service_id.required" => "Service is required",
                "service_id.exists" => "Service not found",

                "end_date.after" => "End date must be after start date",
            ]
        );

        $subscription = Subscription::query()->create($data);

        $subscription->load(["customer", "service"]);

        return response()->json([
            "success" => true,
            "message" => "Subscription created successfully",
            "data" => $subscription,
        ], 201);
    }

    public function show(int $subscription): JsonResponse
    {
        $subscription = Subscription::query()
            ->with(["customer", "service"])
            ->find($subscription);

        if (!$subscription) {
            return response()->json([
                "success" => false,
                "message" => "Subscription not found",
                "errors" => [],
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Subscription retrieved successfully",
            "data" => $subscription,
        ]);
    }

    public function update(Request $request, int $subscription): JsonResponse
    {
        $subscription = Subscription::query()->find($subscription);

        if (!$subscription) {
            return response()->json([
                "success" => false,
                "message" => "Subscription not found",
                "errors" => [],
            ], 404);
        }

        $data = $request->validate([
            "customer_id" => [
                "sometimes",
                "exists:customers,id"
            ],

            "service_id" => [
                "sometimes",
                "exists:services,id"
            ],

            "start_date" => [
                "sometimes",
                "date"
            ],

            "end_date" => [
                "sometimes",
                "date"
            ],

            "status" => [
                "sometimes",
                "in:active,inactive,trial,isolir,dismantle"
            ],
        ]);

        $subscription->update($data);

        $subscription->load(["customer", "service"]);

        return response()->json([
            "success" => true,
            "message" => "Subscription updated successfully",
            "data" => $subscription,
        ]);
    }

    public function destroy(int $subscription): JsonResponse
    {
        $subscription = Subscription::query()->find($subscription);

        if (!$subscription) {
            return response()->json([
                "success" => false,
                "message" => "Subscription not found",
                "errors" => [],
            ], 404);
        }

        $subscription->delete();

        return response()->json([
            "success" => true,
            "message" => "Subscription deleted successfully",
            "data" => null,
        ]);
    }

    public function activate(int $subscription): JsonResponse
    {
        $subscription = Subscription::query()->find($subscription);

        if (!$subscription) {
            return response()->json([
                "success" => false,
                "message" => "Subscription not found",
                "errors" => [],
            ], 404);
        }

        $subscription->update([
            "status" => "active"
        ]);

        return response()->json([
            "success" => true,
            "message" => "Subscription activated successfully",
            "data" => $subscription,
        ]);
    }

    public function deactivate(int $subscription): JsonResponse
    {
        $subscription = Subscription::query()->find($subscription);

        if (!$subscription) {
            return response()->json([
                "success" => false,
                "message" => "Subscription not found",
                "errors" => [],
            ], 404);
        }

        $subscription->update([
            "status" => "inactive"
        ]);

        return response()->json([
            "success" => true,
            "message" => "Subscription deactivated successfully",
            "data" => $subscription,
        ]);
    }
}