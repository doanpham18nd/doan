<?php

namespace App\Http\Controllers;

use App\ScheduleContent;
use App\UserMedicine;
use App\UserSchedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class UserScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            if (empty($data['id'])) {
                $user = $this->checkToken($data['token']);
                unset($data['token']);
                $data['patient_id'] = $user['id'];
                $data['register_date'] = Carbon::now()->toDateString();
                UserSchedule::insert($data);
            } else {
                $schedule = [
                    'title' => $data['title'],
                    'short_content' => $data['short_content']
                ];
                if (!empty($data['thumbnailUpdate'])) {
                    $extension = $data['thumbnailUpdate']->getClientOriginalExtension(); // getting image extension
                    $filename = time() . '.' . $extension;
                    $imageResize = Image::make($data['thumbnailUpdate']->getRealPath());
                    $imageResize->resize(180, 240);
                    $imageResize->save(public_path('images/schedule/' . $filename));
                    $schedule['thumbnail'] = $filename;
                    unset($data['thumbnail']);
                }
                if (!empty($data['scheduleContentUpdate'])) {
                    foreach ($data['scheduleContentUpdate'] as $key => $scheduleContent) {
                        ScheduleContent::where('id', $key)->update(['content' => $scheduleContent]);
                    }
                }
                if (!empty($data['scheduleContentInsert'])) {
                    $scheduleContents = [];
                    foreach ($data['scheduleContentInsert'] as $key => $scheduleContent) {
                        $scheduleContents[$key] = [
                            'schedule_id' => $data['id'],
                            'content' => $scheduleContent,
                            'order' => $key,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                    ScheduleContent::insert($scheduleContents);
                }
                $this->schedule->where('id', $data['id'])->update($schedule);
                $scheduleData = $this->schedule->where('id', $data['id'])->first();
            }
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
     * @param  \App\UserMedicine  $userMedicine
     * @return \Illuminate\Http\Response
     */
    public function show(UserMedicine $userMedicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserMedicine  $userMedicine
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMedicine $userMedicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserMedicine  $userMedicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMedicine $userMedicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserMedicine  $userMedicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMedicine $userMedicine)
    {
        //
    }
}
