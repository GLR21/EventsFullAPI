<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreSubscriptionRequest;
use App\Http\Requests\V1\UpdateSubscriptionRequest;
use App\Http\Resources\V1\SubscriptionCollection;
use App\Models\Subscription;
use App\Http\Resources\V1\SubscriptionResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionEmail;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new SubscriptionCollection(Subscription::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        return new SubscriptionResource(Subscription::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        return Subscription::destroy( $subscription->id );
    }

    public function checkin(Subscription $subscription)
    {
        if( $subscription->dt_unsubscription != null )
        {
            return response()->json(['message' => 'Subscription already canceled'], 400);
        }

        $subscription->dt_checkin = now();
        $subscription->save();
        return new SubscriptionResource($subscription);
    }

    public function cancel(Subscription $subscription)
    {
        if( $subscription->dt_unsubscription != null )
        {
            return response()->json(['message' => 'Subscription already canceled'], 400);
        }

        if( $subscription->dt_checkin != null )
        {
            return response()->json(['message' => 'Subscription already checked-in'], 400);
        }

        $subscription->dt_unsubscription = now();

        $subscription->save();
        return new SubscriptionResource($subscription);
    }

    public function sendSubscriptions( $user )
    {
        $subscriptions = new SubscriptionCollection(Subscription::where('ref_user', $user)->whereNull('dt_checkin')->whereNull( 'dt_unsubscription' )->get());

        $subscriptions = $subscriptions->filter(function($subscription){
            return $subscription->event->dt_start >= now();
        });

        $events = $subscriptions->map(function($subscription){
            return $subscription->event;
        });

        $user = $subscriptions->first()->user;

        if( count($subscriptions) == 0 )
        {
            return response()->json(['message' => 'No subscriptions to send'], 400);
        }

        Mail::to("gabriellange.ramos@gmail.com")->send( new SubscriptionEmail($user, $events));

        return response()->json(['message' => 'Email sent'], 200);
    }
}
