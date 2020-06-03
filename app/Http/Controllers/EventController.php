<?php


namespace App\Http\Controllers;


use App\Services\EventHandlerService;
use Illuminate\Http\Request;


/**
 * @property EventHandlerService event_handler_service
 */

class EventController extends Controller
{
    public function __construct(EventHandlerService $eventHandlerService)
    {
        $this->event_handler_service = $eventHandlerService;
    }

    public function write_event(Request $request)
    {
        $this->event_handler_service->handle_event(json_decode($request->getContent()));
        return \Response::noContent();
    }
}
