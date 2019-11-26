<?php

namespace App\Http\Controllers\Admin;

use App\Medicine;
use App\Promotion;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arc = Promotion::paginate(10);
        return view('admin.promotion.list', compact('arc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotion.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            if (empty($data['id'])) {
                $medicine = [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'alias' => Str::slug($data['title']),
                    'start_date' => Carbon::parse($data['start_date'])->toDateString(),
                    'end_date' =>  Carbon::parse($data['end_date'])->toDateString()
                ];
                $extension = $data['slide_image']->getClientOriginalExtension(); // getting image extension
                $filename = time() . Str::random(2) . '.' . $extension;
                $imageResize2 = Image::make($data['slide_image']->getRealPath());
                $imageResize2->save(public_path('images/promotion/slide/' . $filename));
                $medicine['slide_image'] = $filename;

                //content
                $extension2 = $data['content_image']->getClientOriginalExtension(); // getting image extension
                $filename2 = time() . '.' . $extension2;
                $imageResize3 = Image::make($data['content_image']->getRealPath());
                $imageResize3->save(public_path('images/promotion/' . $filename2));
                $medicine['content_image'] = $filename2;
                Promotion::insert($medicine);
            } else {
                $medicine = [
                    'title' => $data['title'],
                    'alias' => Str::slug($data['title']),
                    'content' => $data['content'],
                    'start_date' => Carbon::parse($data['start_date'])->toDateString(),
                    'end_date' =>  Carbon::parse($data['end_date'])->toDateString()
                ];
                if (!empty($data['slide_image'])) {
                    $extension = $data['slide_image']->getClientOriginalExtension(); // getting image extension
                    $filename = time() . '.' . $extension;
                    $imageResize = Image::make($data['slide_image']->getRealPath());
                    $imageResize->save(public_path('images/promotion/slide/' . $filename));
                    $medicine['slide_image'] = $filename;
                }
                if (!empty($data['content_image'])) {
                    $extension = $data['content_image']->getClientOriginalExtension(); // getting image extension
                    $filename = time() . Str::random(2) . '.' . $extension;
                    $imageResize = Image::make($data['content_image']->getRealPath());
                    $imageResize->save(public_path('images/promotion/' . $filename));
                    $medicine['content_image'] = $filename;
                }
                Promotion::where('id', $data['id'])->update($medicine);
            }
            DB::commit();
            return redirect()->route('promotionList');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
