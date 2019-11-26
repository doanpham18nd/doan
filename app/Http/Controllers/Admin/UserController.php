<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $request;
    protected $user;

    /**
     *
     * @param Request $request
     * @param Product $user
     */
    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->where('id', '!=', 1)->get();
        return view('admin.user.list', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $this->request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'max:127',
                'email' => 'required|email|max:127|unique:users,email',
                'password' => 'required'
            ]);
//            if ($validator->fails()) {
//                return response()->json([
//                    'status' => 0,
//                    'error' => $validator->errors()], 401);
//            }
            if (!empty($data['file'])) {
                $extension = $data['file']->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $data['file']->move('images/users/', $filename);
                $data['picture'] = $filename;
                unset($data['file']);
            }
            $data['password'] = Hash::make($data['password']);
            $userId = $this->user->insertGetId($data);
            $user = $this->user->find($userId);
            return response()->json(['data' => $user,
                'status' => 1]);
        } catch (Exception $exception) {
            return response()->json(['status' => 0]);
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
                    return response()->json(['status' => 1]);
                }
                return response()->json(['status' => 0]);
            }
            return response()->json(['status' => 0, 'error' => 'Token not found or expired']);
        } catch (Exception $exception) {
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

        return response()->json(['status' => Response::HTTP_OK]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        return view('admin.user.detail', compact('user'));
    }
}
