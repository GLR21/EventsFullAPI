<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreEventRequest;
use App\Http\Requests\V1\UpdateEventRequest;
use App\Http\Resources\V1\EventCollection;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Carbon\Carbon;



class EventController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/events",
     *      operationId="index",
     *      tags={"Events"},
     *      summary="List all events",
     *      description="Returns a list of all events",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                ),
     *                @OA\Property(
     *                  property="name",
     *                  type="string",
     *                ),
     *                @OA\Property(
     *                  property="description",
     *                  type="string"
     *                ),
     *                @OA\Property(
     *                  property="dt_start",
     *                  type="date"
     *                ),
     *                @OA\Property(
     *                  property="dt_end",
     *                  type="date"
     *                ),
     *                @OA\Property(
     *                  property="dt_start_subscription",
     *                  type="date"
     *                ),
     *                @OA\Property(
     *                  property="dt_end_subscription",
     *                  type="date"
     *                ),
     *              )
     *            )
     *     )
     *
     * )
    */
    public function index()
    {
        return new EventCollection(Event::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /** @OA\Post(
     *      path="/api/v1/events/register",
     *      tags={"Events"},
     *      summary="Register a new event",
     *      description="Returns the created event",
     *      security={{"bearerAuth": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "description", "dt_start", "dt_end", "dt_start_subscription", "dt_end_subscription"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="Event name"
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  type="string",
     *                  example="Event description"
     *              ),
     *              @OA\Property(
     *                  property="dt_start",
     *                  type="date"
     *              ),
     *              @OA\Property(
     *                  property="dt_end",
     *                  type="date"
     *              ),
     *              @OA\Property(
     *                  property="dt_start_subscription",
     *                  type="date"
     *              ),
     *              @OA\Property(
     *                  property="dt_end_subscription",
     *                  type="date"
     *             ),
     *         )
     *     ),
     *    @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *          type="object",
     *          @OA\Property(
     *              property="id",
     *              type="integer",
     *          ),
     *          @OA\Property(
     *              property="name",
     *              type="string",
     *              example="Event name"
     *          ),
     *          @OA\Property(
     *              property="description",
     *              type="string",
     *              example="Event description"
     *          ),
     *          @OA\Property(
     *              property="dt_start",
     *              type="date"
     *          ),
     *          @OA\Property(
     *              property="dt_end",
     *              type="date"
     *          ),
     *          @OA\Property(
     *              property="dt_start_subscription",
     *              type="date"
     *          ),
     *          @OA\Property(
     *              property="dt_end_subscription",
     *              type="date"
     *          ),
     *         )
     *    )
     * )
    */
    public function store(StoreEventRequest $request)
    {
        $data = $request->all();

        $dtStart = Carbon::parse($data['dt_start']);
        $dtEnd = Carbon::parse($data['dt_end']);
        $dtStartSubscription = Carbon::parse($data['dt_start_subscription']);
        $dtEndSubscription = Carbon::parse($data['dt_end_subscription']);

        if( $dtStart->greaterThanOrEqualTo( $dtEnd ) )
        {
            return response()->json(['message' => 'Start date must be less than end date'], 400);
        }

        if( $dtStartSubscription->greaterThanOrEqualTo( $dtEndSubscription ) )
        {
            return response()->json(['message' => 'Start subscription date must be less than end subscription date'], 400);
        }

        if (
            !($dtStartSubscription->between($dtStart, $dtEnd) && $dtEndSubscription->between($dtStart, $dtEnd)) &&
            !($dtEndSubscription->lessThan($dtStart) && $dtStartSubscription->lessThan($dtStart))
        ) {
            return response()->json(['message' => 'Subscription dates must be either within the event dates or entirely before the event dates'], 400);
        }

        $event = Event::create($data);

        if( !$event )
        {
            return response()->json(['message' => 'Error creating event'], 500);
        }

        return new EventResource($event);
    }


    /**
    * @OA\Get(
    *      path="/api/v1/events/{event}",
    *      operationId="show",
    *      tags={"Events"},
    *      summary="Show an event",
    *      description="Returns an event by ID",
    *      security={{"bearerAuth": {}}},
    *      @OA\Parameter(
    *          name="event",
    *          in="path",
    *          description="Event ID",
    *          required=true,
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *              type="object",
    *              @OA\Property(
    *                  property="id",
    *                  type="integer",
    *              ),
    *              @OA\Property(
    *                  property="name",
    *                  type="string",
    *              ),
    *              @OA\Property(
    *                  property="description",
    *                  type="string"
    *              ),
    *              @OA\Property(
    *                  property="dt_start",
    *                  type="date"
    *              ),
    *              @OA\Property(
    *                  property="dt_end",
    *                  type="date"
    *              ),
    *              @OA\Property(
    *                  property="dt_start_subscription",
    *                  type="date"
    *              ),
    *              @OA\Property(
    *                  property="dt_end_subscription",
    *                  type="date"
    *              ),
    *          )
    *       ),
    *     )
    */
    public function show(Event $event)
    {
        return new EventResource( $event );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * /**
     * @OA\Delete(
     *      path="/api/v1/events/{event}/delete",
     *      operationId="destroy",
     *      tags={"Events"},
     *      summary="Delete an event",
     *      description="Delete an event by ID",
     *      @OA\Parameter(
     *          description="Event ID",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(type="int"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Event deleted",
     *       ),
     *     )
     */
    public function destroy(Event $event)
    {
        if( Carbon::parse( $event->dt_end ) <= Carbon::now() )
        {
            return response()->json(['message' => 'Event has already ended'], 400);
        }

        if( $event->subscriptions()->count() > 0 )
        {
            return response()->json(['message' => 'Event has subscriptions'], 400);
        }

        if( !$event->delete() )
        {
            return response()->json(['message' => 'Error deleting event'], 500);
        }

        return response()->json(['message' => 'Event deleted'], 200);
    }
}
