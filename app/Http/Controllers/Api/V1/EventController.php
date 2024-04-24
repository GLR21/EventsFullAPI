<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreEventRequest;
use App\Http\Requests\V1\UpdateEventRequest;
use App\Http\Resources\V1\EventCollection;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;


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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
