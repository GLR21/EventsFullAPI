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
     * @OA\Get(
     *      path="/api/v1/subscriptions",
     *      tags={"Subscriptions"},
     *      summary="List all subscriptions",
     *      description="Returns a list of all subscriptions",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="ref_user",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="ref_event",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_subscription",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_unsubscription",
     *                      nullable=true,
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_checkin",
     *                      nullable=true,
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_email_sent",
     *                      nullable=true,
     *                      type="date"
     *                  ),
     *             )
     *         )
     *    )
     * )
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
     * @OA\Post(
     *     path="/api/v1/subscriptions/register",
     *     operationId="store",
     *     tags={"Subscriptions"},
     *     summary="Register a new subscription",
     *     description="Register a new subscription",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *          required={"ref_user", "ref_event", "dt_subscription"},
     *          @OA\Property(
     *              property="ref_user",
     *              type="integer",
     *              description="User ID"
     *          ),
     *          @OA\Property(
     *              property="ref_event",
     *              type="integer",
     *              description="Event ID"
     *          ),
     *          @OA\Property(
     *              property="dt_subscription",
     *              type="date",
     *              description="Subscription date"
     *          ),
     *        )
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="Successful operation",
     *        @OA\JsonContent(
     *          @OA\Property(
     *              property="id",
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="ref_user",
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="ref_event",
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="dt_subscription",
     *              type="date"
     *          ),
     *          @OA\Property(
     *              property="dt_unsubscription",
     *              nullable=true,
     *              type="date"
     *          ),
     *          @OA\Property(
     *              property="dt_checkin",
     *              nullable=true,
     *              type="date"
     *          ),
     *          @OA\Property(
     *              property="dt_email_sent",
     *              nullable=true,
     *              type="date"
     *          ),
     *        )
     *     )
     * )
     */
    public function store(StoreSubscriptionRequest $request)
    {
        return new SubscriptionResource(Subscription::create($request->all()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/subscriptions/{subscription}",
     *     tags={"Subscriptions"},
     *     summary="Show a subscription",
     *     description="Returns a subscription by ID",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *        name="subscription",
     *        in="path",
     *        description="Subscription ID",
     *        required=true,
     *        @OA\Schema(
     *          type="integer"
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                      property="id",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="ref_user",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="ref_event",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_subscription",
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_unsubscription",
     *                      nullable=true,
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_checkin",
     *                      nullable=true,
     *                      type="date"
     *                  ),
     *                  @OA\Property(
     *                      property="dt_email_sent",
     *                      nullable=true,
     *                      type="date"
     *                  ),
     *            )
     *     )
     * )
     *
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


    /**
     * @OA\Post(
     *     path="/api/v1/subscriptions/{subscription}/checkin",
     *     operationId="checkin",
     *     tags={"Subscriptions"},
     *     summary="Check-in a subscription",
     *     description="Check-in a subscription",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *        name="subscription",
     *        in= "path",
     *        description="Subscription ID",
     *        required=true,
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                 property="id",
     *                 type="integer"
     *               ),
     *               @OA\Property(
     *                 property="ref_user",
     *                 type="integer"
     *               ),
     *              @OA\Property(
     *                 property="ref_event",
     *                 type="integer"
     *              ),
     *              @OA\Property(
     *                 property="dt_subscription",
     *                 type="date"
     *              ),
     *              @OA\Property(
     *                 property="dt_unsubscription",
     *                 nullable=true,
     *                 type="date"
     *              ),
     *              @OA\Property(
     *                 property="dt_checkin",
     *                 nullable=true,
     *                 type="date"
     *              ),
     *              @OA\Property(
     *                 property="dt_email_sent",
     *                 nullable=true,
     *                 type="date"
     *              ),
     *         )
     *     )
     * )
     */
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


    /**
     * @OA\Post(
     *     path="/api/v1/subscriptions/{subscription}/cancel",
     *     operationId="cancel",
     *     tags={"Subscriptions"},
     *     summary="Cancels from a subscription",
     *     description="Cancels from a subscription",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *        name="subscription",
     *        in= "path",
     *        description="Subscription ID",
     *        required=true,
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                 property="id",
     *                 type="integer"
     *               ),
     *               @OA\Property(
     *                 property="ref_user",
     *                 type="integer"
     *               ),
     *              @OA\Property(
     *                 property="ref_event",
     *                 type="integer"
     *              ),
     *              @OA\Property(
     *                 property="dt_subscription",
     *                 type="date"
     *              ),
     *              @OA\Property(
     *                 property="dt_unsubscription",
     *                 nullable=true,
     *                 type="date"
     *              ),
     *              @OA\Property(
     *                 property="dt_checkin",
     *                 nullable=true,
     *                 type="date"
     *              ),
     *              @OA\Property(
     *                 property="dt_email_sent",
     *                 nullable=true,
     *                 type="date"
     *              ),
     *         )
     *     )
     * )
    */
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


    /**
     * @OA\Get(
     *   path="/api/v1/subscription/{user}/email",
     *   operationId="sendSubscriptions",
     *   tags={"Subscriptions"},
     *   summary="Send all subscriptions to a user's email",
     *   description="Send all subscriptions to a user's email that have not been checked-in or canceled, and the event has not yet started",
     *   security={{"bearerAuth": {}}},
     *   @OA\Parameter(
     *    name="user",
     *    in="path",
     *    description="User ID",
     *    required=true,
     *    @OA\Schema(
     *      type="integer"
     *    )
     *   ),
     *   @OA\Response(
     *         response=200,
     *         description="E-mail sent",
     *         @OA\JsonContent(
     *           type="object",
     *            @OA\Property(
     *                property="message",
     *                type="string"
     *           )
     *         )
     *   ),
     *   @OA\Response(
     *         response=400,
     *         description="No subscriptions to send",
     *         @OA\JsonContent(
     *           type="object",
     *           @OA\Property(
     *                property="message",
     *                type="string"
     *           )
     *         )
     *   ),
     * )
     */
    public function sendSubscriptions( $user )
    {
        $subscriptions = new SubscriptionCollection(Subscription::where('ref_user', $user)->whereNull('dt_checkin')->whereNull( 'dt_unsubscription' )->get());

        $subscriptions = $subscriptions->filter(function($subscription){
            return $subscription->event->dt_start >= now();
        });

        $events = $subscriptions->map(function($subscription){
            return $subscription->event;
        });

        if( $subscriptions->count() == 0 )
        {
            return response()->json(['message' => 'No subscriptions to send'], 400);
        }

        $user = $subscriptions->first()->user;

        if( count($subscriptions) == 0 )
        {
            return response()->json(['message' => 'No subscriptions to send'], 400);
        }

        Mail::to(env( 'MAILTRAP_EMAIL_TEST_RECEIVER' ))->send( new SubscriptionEmail($user, $events));

        return response()->json(['message' => 'Email sent'], 200);
    }
}
