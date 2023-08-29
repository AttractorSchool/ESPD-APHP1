<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Subscription;
use App\Services\Payment\CloudPayment\CloudPaymentCredentials;
use App\Services\Payment\CloudPayment\CloudPaymentProvider;
use App\Services\Payment\CloudPayment\DTO\ChargeRequest;
use App\Services\Payment\CloudPayment\Payment;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse
     */
    public function subscribe(Request $request): RedirectResponse
    {
        $subscriptionId = $request->input('subscriptionId');
        $subscription = Subscription::findOrFail($subscriptionId);

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasActiveSubscription()) {
                return redirect('/')->with('error', 'У вас уже есть действующая подписка.');
            }

            $cryptogram = $request->input('cryptogram');

            try {
                if ($subscriptionId == 1) {
                    $startDate = Carbon::now();
                    $endDate = Carbon::now()->addDays(7);

                    $order = new Order();
                    $order->user_id = $user->id;
                    $order->subscription_id = $subscription->id;
                    $order->amount = 0;
                    $order->status = 'Activated';
                    $order->save();

                    $user->subscriptions()->attach($subscription, [
                        'start_date' => $startDate,
                        'end_date' => $endDate->toDateTimeString(),
                    ]);

                    return redirect('/')->with('status', 'Подписка успешно активирована.');
                } else {
                    $cpManager = new CloudPaymentProvider(
                        new CloudPaymentCredentials(
                            'pk_9cd515fbae45c8a3f25fe6cf03a5f',
                            '9c285d3ef21ea893650116e98a9a10b3'
                        )
                    );

                    $payment = new Payment($subscription->price, $cryptogram);

                    $paymentSuccess = $cpManager->pay($payment);

                    if ($paymentSuccess) {
                        $startDate = Carbon::now();

                        switch ($subscriptionId) {
                            case 1:
                                $startDate->addDays(7);
                                break;
                            case 2:
                                $startDate->addDays(30);
                                break;
                            case 3:
                                $startDate->addDays(365);
                                break;
                            default:
                                return redirect('/')->with('error', 'Произошла ошибка при оформлении подписки.');
                        }

                        $order = new Order();
                        $order->user_id = $user->id;
                        $order->subscription_id = $subscription->id;
                        $order->amount = $subscription->price;
                        $order->status = 'Activated';
                        $order->save();

                        $user->subscriptions()->attach($subscription, [
                            'start_date' => Carbon::now(),
                            'end_date' => $startDate->toDateTimeString(),
                        ]);

                        return redirect('/')->with('status', 'Вы успешно оформили подписку.');
                    } else {
                        return redirect('/')->with('error', 'Произошла ошибка при оплате подписки.');
                    }
                }
            } catch (\Exception $e) {
                return redirect('/')->with('error', 'Произошла ошибка при оформлении подписки: ' . $e->getMessage());
            }
        }

        return redirect('/')->with('error', 'Произошла ошибка при оформлении подписки.');
    }


    /**
     * @param Request $request
     * @return View
     */
    public function showCardForm(Request $request): View
    {
        $subscriptionId = $request->input('subscriptionId');
        $subscription = Subscription::findOrFail($subscriptionId);

        return view('payment.payment', compact('subscription'));
    }
}
