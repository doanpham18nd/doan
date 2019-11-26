<?php

namespace App\Http\Controllers\Admin;

use App\Articles;
use App\DoctorUser;
use App\Medicine;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('admin.index');
//        $data['suggest'] = Medicine::inRandomOrder()->limit(6)->get();
//        $data['dealHot'] = Medicine::inRandomOrder()->skip(6)->take(6)->get();
//        $data['new'] = Medicine::limit(6)->orderBy('id', 'desc')->get();
//        $data['article'] = Articles::whereIn('id', config('ads'))->get();
//        $data['newPost'] = Articles::whereNotIn('id', [13, 14])->limit(3)->orderBy('id', 'desc')->get();
//        return $this->responseSuccess($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorUser  $doctorUser
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorUser $doctorUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorUser  $doctorUser
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorUser $doctorUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorUser  $doctorUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorUser $doctorUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorUser  $doctorUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorUser $doctorUser)
    {
        //
    }
}
