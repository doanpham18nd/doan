<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\ScheduleContent;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleContentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ScheduleContent $scheduleContent
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleContent $scheduleContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ScheduleContent $scheduleContent
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleContent $scheduleContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ScheduleContent $scheduleContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleContent $scheduleContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $scheduleData = [];
            $scheduleContent = ScheduleContent::find($id);
            if ($scheduleContent) {
                ScheduleContent::destroy($id);
                $scheduleData = Schedule::where('id', $scheduleContent['schedule_id'])->with('scheduleContents')->first();
            }
            return $this->responseSuccess($scheduleData);
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
