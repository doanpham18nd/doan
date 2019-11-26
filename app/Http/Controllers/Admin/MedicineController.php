<?php

namespace App\Http\Controllers\Admin;

use App\Medicine;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class MedicineController extends Controller
{
    protected $request;
    protected $user;

    /**
     *
     * @param Request $request
     * @param Product $user
     */
    public function __construct(Request $request, Medicine $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $medicines = Medicine::paginate(10);
        return view('admin.medicine.list', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
                    'alias' => str_slug($data['name']),
                    'category' => $data['category']
                ];
                $extension = $data['thumbnail']->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $imageResize = Image::make($data['thumbnail']->getRealPath());
                $imageResize->resize(120, 180);
                $imageResize->save(public_path('images/medicine/thumbnail/' . $filename));
                $imageResize2 = Image::make($data['thumbnail']->getRealPath());
                $imageResize2->save(public_path('images/medicine/' . $filename));
                $medicine['thumbnail'] = $filename;
                Medicine::insertGetId($medicine);
            } else {
                $medicine = [
                    'name' => $data['name'],
                    'alias' => str_slug($data['name']),
                    'content' => $data['content'],
                    'short_content' => $data['short_content'],
                    'price' => $data['price'],
                    'category' => $data['category']
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
            }
            DB::commit();
            return redirect()->route('medicineList');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
     * @param  int $id
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
            $symptomData = Medicine::where('id', $id)->first();
            $category1 = config('category')['category1'];
            $category2 = config('category')['category2'];
            $category3 = config('category')['category3'];
            return view('admin.medicine.edit', compact('symptomData', 'category3', 'category2', 'category1'));
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category1 = config('category')['category1'];
        $category2 = config('category')['category2'];
        $category3 = config('category')['category3'];
        return view('admin.medicine.add', compact('category1', 'category2', 'category3'));
    }
}
