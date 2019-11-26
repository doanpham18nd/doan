<?php

namespace App\Http\Controllers;

use App\Medicine;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use League\Flysystem\Config;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = config('category');
        return $this->responseSuccess($user);
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
                    'name' => $data['name'],
                    'content' => $data['content'],
                    'short_content' => $data['short_content'],
                    'price' => $data['price'],
                ];
                $extension = $data['thumbnail']->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $imageResize = Image::make($data['thumbnail']->getRealPath());
                $imageResize->resize(120, 180);
                $imageResize->save(public_path('images/medicine/thumbnail/' . $filename));
                $imageResize2 = Image::make($data['thumbnail']->getRealPath());
                $imageResize2->save(public_path('images/medicine/' . $filename));
                $medicine['thumbnail'] = $filename;
                $medicineId = Medicine::insertGetId($medicine);
                $medicineData = Medicine::where('id', $medicineId)->first();
            } else {
                $medicine = [
                    'name' => $data['name'],
                    'content' => $data['content'],
                    'short_content' => $data['short_content'],
                    'price' => $data['price']
                ];
                if (!empty($data['thumbnailUpdate'])) {
                    $extension = $data['thumbnailUpdate']->getClientOriginalExtension(); // getting image extension
                    $filename = time() . '.' . $extension;
                    $imageResize = Image::make($data['thumbnailUpdate']->getRealPath());
                    $imageResize->resize(120, 180);
                    $imageResize->save(public_path('images/medicine/thumbnail/' . $filename));
                    $imageResize2 = Image::make($data['thumbnailUpdate']->getRealPath());
                    $imageResize2->save(public_path('images/medicine/' . $filename));
                    $medicine['thumbnail'] = $filename;
                }
                Medicine::where('id', $data['id'])->update($medicine);
                $medicineData = Medicine::where('id', $data['id'])->first();
            }
            DB::commit();
            return $this->responseSuccess($medicineData);
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $this->request->all();
            $checkToken = $this->checkToken($data['token']);
            if ($checkToken) {
                $validator = Validator::make($request->all(), [
                    'name' => 'max:127',
                    'email' => 'required|email|max:127|unique:users,email,' . $id,
                    'password' => 'required',
                    'birthday' => 'date'
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 0,
                        'error' => $validator->errors()], 401);
                }
                unset($data['token']);
                if (!empty($data['file'])) {
                    $extension = $data['file']->getClientOriginalExtension(); // getting image extension
                    $filename = time() . '.' . $extension;
                    $data['file']->move('images/users/', $filename);
                    $data['picture'] = $filename;
                    unset($data['file']);
                }
                if ($this->user->where('id', $id)->update($data)) {
                    DB::commit();
                    return response()->json(['status' => 1]);
                }
                return response()->json(['status' => 0]);
            }
            return response()->json(['status' => 0, 'error' => 'Token not found or expired']);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 0, 'error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = $this->user->find($id);
        $user->delete();

        return response()->json(['status' => 1]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function show($id)
    {
        try {
            $user = config('category');
            $symptomData = Medicine::where('category', $id)->paginate(6)->toArray();
            if ($id <= 5) {
                $symptomData['cate_name'] = $user['category1'][$id - 1]['name'];
            } elseif ($id > 5 && $id <= 10) {
                $symptomData['cate_name'] = $user['category2'][$id - 6]['name'];
            } else {
                $symptomData['cate_name'] = $user['category3'][$id - 11]['name'];
            }
            return $this->responseSuccess($symptomData);
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
