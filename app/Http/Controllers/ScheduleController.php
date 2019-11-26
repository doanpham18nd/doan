<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\ScheduleContent;
use App\UserSchedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ScheduleController extends Controller
{

    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $scheduleData = $this->schedule->all();
            return $this->responseSuccess($scheduleData);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blocks.schedule.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['register_date'] = Carbon::now();
            UserSchedule::insert($data);
            $scheduleData = Schedule::where('id', $data['schedule_id'])->with('scheduleContents')->first();
            DB::commit();
            return $this->responseSuccess($scheduleData);
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Schedule $schedule
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $scheduleData = Schedule::where('id', $id)->with('scheduleContents')->first();
            return $this->responseSuccess($scheduleData);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        try {
            dd(1);
            $scheduleData = $this->schedule->find($id);
            return $this->responseSuccess($scheduleData);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        print_r($request->all());
        die;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        dd(1);
    }

    public function getScheduleByUser($userId)
    {
        $user = UserSchedule::where('user_id', $userId)->orderBy('register_date', 'desc')->first();
        if (!empty($user)) {
            $registerDate = Carbon::now()->diffInDays($user->register_date);
            $data = ScheduleContent::where('schedule_id', $user->schedule_id)->where('order', $registerDate + 1)->first();
            return $this->responseSuccess($data);
        }
        return $this->responseSuccess();
    }
}
