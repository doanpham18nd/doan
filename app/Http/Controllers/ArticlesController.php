<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Medicine;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class ArticlesController extends Controller
{
    protected $articles;

    public function __construct(Articles $articles)
    {
        $this->articles = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $arc['list'] = Articles::all();
        $arc['mostArticle'] = Articles::limit(5)->orderBy('view', 'desc')->get();
        return $this->responseSuccess($arc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'register_date' => 'date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()], 401);
        }
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
            if (empty($data['id'])) {
                $medicine = [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'short_content' => $data['short_content'],
                    'alias' => str_slug($data['title'])
                ];
                $extension = $data['thumbnail']->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $imageResize = Image::make($data['thumbnail']->getRealPath());
                $imageResize->resize(180, 120);
                $imageResize->save(public_path('images/article/thumbnail/' . $filename));
                $imageResize2 = Image::make($data['thumbnail']->getRealPath());
                $imageResize2->save(public_path('images/article/' . $filename));
                $medicine['thumbnail'] = $filename;
                $medicineId = Articles::insertGetId($medicine);
                $medicineData = Articles::where('id', $medicineId)->first();
            } else {
                $medicine = [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'short_content' => $data['short_content'],
                    'alias' => str_slug($data['title'])
                ];
                if (!empty($data['thumbnailUpdate'])) {
                    $extension = $data['thumbnailUpdate']->getClientOriginalExtension(); // getting image extension
                    $filename = time() . '.' . $extension;
                    $imageResize = Image::make($data['thumbnailUpdate']->getRealPath());
                    $imageResize->resize(180, 120);
                    $imageResize->save(public_path('images/article/thumbnail/' . $filename));
                    $imageResize2 = Image::make($data['thumbnailUpdate']->getRealPath());
                    $imageResize2->save(public_path('images/article/' . $filename));
                    $medicine['thumbnail'] = $filename;
                }
                Articles::where('id', $data['id'])->update($medicine);
                $medicineData = Articles::where('id', $data['id'])->first();
            }
            DB::commit();
            return $this->responseSuccess($medicineData);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $arc['detail'] = $this->articles->find($id);
        $arc['relatedActive'] = $this->articles->inRandomOrder()->whereNotIn('id', [$id])->limit(3)->get();
        $arc['related'] = $this->articles->whereNotIn('id', [$id])->skip(3)->take(3)->get();
        return $this->responseSuccess($arc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Articles $articles
     * @return Response
     */
    public function edit(Articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Articles $articles
     * @return Response
     */
    public function update(Request $request, Articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Articles $articles
     * @return Response
     */
    public function destroy(Articles $articles)
    {
        //
    }
}
