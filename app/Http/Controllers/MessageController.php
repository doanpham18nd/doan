<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\ChatEvent;
use App\Message;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data['count'] = 0;
        $subQuery = Message::select(DB::raw('patient_id as mess_patient_id'), DB::raw('MAX(created_at) as last_created'))
            ->groupBy('mess_patient_id')->where('admin_id', 1);
        $data['data'] = Message::select('admin_id', 'id', 'patient_id', 'content', 'created_at', 'type', 'read_flg')
            ->joinSub($subQuery, 'latest_mess', function ($join) {
                $join->on(
                    'messages.patient_id', '=', 'latest_mess.mess_patient_id'
                );
                $join->on(
                    'messages.created_at', '=', 'latest_mess.last_created'
                );
            })
            ->where('admin_id', 1)->orderBy('created_at', 'desc')->limit(5)->get();
        if (!empty($data['data'])) {
            $countData = $data['data']->toArray();
            foreach ($countData as $countDatum) {
                if ($countDatum['type'] != 1 && $countDatum['read_flg'] == 0) {
                    $data['count'] = $data['count'] + 1;
                }
            }
        }
        return $this->responseSuccess($data);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->only('patient_id', 'admin_id', 'type', 'content');
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $id = Message::insertGetId($data);
            DB::commit();
            $res = Message::where('id', $id)->first();
            broadcast(new ChatEvent($res))->toOthers();
            return $this->responseSuccess($res);
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Message $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = Message::where('patient_id', $id)->where('admin_id', 1)->limit(10)->orderBy('created_at', 'desc')->get()->toArray();
        $data = array_reverse($data);
        return $this->responseSuccess($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        try {
            DB::beginTransaction();
            dd($id);
            Message::where('patient_id', $id)->where('admin_id', 1)->update(['read_flg' => 1]);
            DB::commit();
            return $this->responseSuccess();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    public function read($id)
    {
        try {
            DB::beginTransaction();
            dd($id);
            Message::where('patient_id', $id)->where('admin_id', 1)->update(['read_flg' => 1]);
            DB::commit();
            return $this->responseSuccess();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
