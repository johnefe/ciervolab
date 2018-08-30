<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
	public function __construct() {
		$this->middleware(function($request, $next) {
			if ( auth()->user()->subscribed('main') ) {
				return redirect('/')
					->with('message', ['warning', __("Actualmente ya estás suscrito a otro plan")]);
			}
			return $next($request);
		})
		->only(['plans', 'processSubscription']);
	}

	public function plans () {
		return view('subscriptions.plans');
    }

    public function processSubscription () {
	    $token = request('stripeToken');
	    try {
			if ( \request()->has('coupon')) {
				\request()->user()->newSubscription('main', \request('type'))
					->withCoupon(\request('coupon'))->create($token);
			} else {
				\request()->user()->newSubscription('main', \request('type'))
				          ->create($token);
			}
		    return redirect(route('subscriptions.admin'))
			    ->with('message', ['success', __("La suscripción se ha llevado a cabo correctamente")]);
	    } catch (\Exception $exception) {
	    	$error = $exception->getMessage();
	    	return back()->with('message', ['danger', $error]);
	    }
    }

    public function admin () {
		$subscriptions = auth()->user()->subscriptions;
		return view('subscriptions.admin', compact('subscriptions'));
    }

    public function resume () {
		$subscription = \request()->user()->subscription(\request('plan'));
		if ($subscription->cancelled() && $subscription->onGracePeriod()) {
			\request()->user()->subscription(\request('plan'))->resume();
			return back()->with('message', ['success', __("Has reanudado tu suscripción correctamente")]);
		}
		return back();
    }

    public function cancel () {
		auth()->user()->subscription(\request('plan'))->cancel();
	    return back()->with('message', ['success', __("La suscripción se ha cancelado correctamente")]);
    }
}
