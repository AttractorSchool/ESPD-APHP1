<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubscriptionsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $subscriptions = Subscription::all();

        return view('front.subscriptions', ['subscriptions' => $subscriptions]);
    }

    /**
     * @param Request $request
     * @param Subscription $subscription
     * @return JsonResponse
     */
    public function subscribe(Request $request, Subscription $subscription): JsonResponse
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasActiveSubscription()) {
                return response()->json(['success' => false, 'message' => 'У вас уже есть действующая подписка.']);
            }

            $startDate = Carbon::now();

            switch ($request->subscription_type) {
                case 'Free':
                    $startDate->addDays(7);
                    break;
                case 'Standard':
                    $startDate->addDays(30);
                    break;
                case 'Premium':
                    $startDate->addDays(365);
                    break;
            }

            $user->subscriptions()->attach($subscription, [
                'start_date' => Carbon::now(),
                'end_date' => $startDate->toDateTimeString(),
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Чтобы подписаться, необходимо войти в свой аккаунт.']);
    }
}
