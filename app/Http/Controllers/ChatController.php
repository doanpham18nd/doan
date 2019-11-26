<?php

namespace App\Http\Controllers;

use App\Events\Chat;
use App\Events\Read;
use App\Events\SubmitChat;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index()
    {
        if(Auth::user()->id != 1) {
            $data = Message::where('patient_id', Auth::user()->id)->where('admin_id', 1)->limit(10)->orderBy('created_at', 'desc')->get()->toArray();
        } else {
            $data = Message::where('patient_id', 2)->where('admin_id', Auth::user()->id)->limit(10)->orderBy('created_at', 'desc')->get()->toArray();
        }
        if (!empty($data)) {
            $data = array_reverse($data);
        }
        return $this->responseSuccess($data);
    }

    public function chatAdmin(Request $request)
    {
        $data = $request->only('content', 'patient_id');
        $data['admin_id'] = Auth::user()->id;
        $data['type'] = 1;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $id = Message::insertGetId($data);
        Message::where('patient_id', $id)->where('admin_id', Auth::user()->id)->update(['read_flg' => 1]);
        $res = Message::where('id', $id)->first();
        //broadcast
        broadcast(new Chat($res, $request->user()));
        return $this->responseSuccess($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chat(Request $request)
    {
        $data = $request->only('content', 'patient_id', 'admin_id');
        $data['admin_id'] = 1;
        $data['type'] = 0;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $id = Message::insertGetId($data);
        $res = Message::where('id', $id)->first();
        //broadcast
        broadcast(new Chat($res, $request->user()));
        return $this->responseSuccess($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAfter(Request $request)
    {
        $data = Message::where('id', '>', $request->id)->where('patient_id', $request->user_id)->orderBy('id', 'desc')->get();
        return $this->responseSuccess($data);
    }
}
