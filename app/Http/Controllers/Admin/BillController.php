<?php

namespace App\Http\Controllers\Admin;

use App\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function waitingPay()
    {
        $data = Bill::where('status', 0)->with('user')->with('address')->get();
        return view('admin.bill.list.waitingPay', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivering()
    {
        $data = Bill::where('status', 1)->with('user')->with('address')->get();
        return view('admin.bill.list.delivering', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivered()
    {
        $data = Bill::where('status', 2)->with('user')->with('address')->get();
        return view('admin.bill.list.delivered', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function canceled()
    {
        $data = Bill::where('status', 3)->with('user')->with('address')->get();
        return view('admin.bill.list.cancel', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = Bill::where('id', $id)->with('user')->with('billDetail')->with('address')->first();
        switch ($data->status) {
            case 0:
                return view('admin.bill.waitingPay',compact('data'));
                break;
            case 1:
                return view('admin.bill.delivering',compact('data'));
                break;
            case 2:
                return view('admin.bill.delivered',compact('data'));
                break;
            default:
                return view('admin.bill.cancel',compact('data'));
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $data['deliver_id'] = $request->deliver_id;
        $data['status'] = $request->status;
        Bill::where('id', $id)->update($data);
        return redirect()->route('getStatusBill', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
