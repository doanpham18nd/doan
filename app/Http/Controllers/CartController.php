<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Bill;
use App\BillDetail;
use App\Cart;
use App\User;
use App\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first());
        }
        $user = User::where(['email' => $data['email'], 'password' => Hash::check('password', $data['password'])])->with('address')->first();
        if ($user) {
            $token['token'] = Str::random(64);
            $token['user_id'] = $user['id'];
            $token['delete_flg'] = 0;
            Auth::insert($token);
            $user['token'] = $token['token'];
            if (!empty($data['userId']) && isset($_SESSION['cart' . $data['userId']])) {
                $res = $_SESSION['cart' . $data['userId']];
                $newUserId = 'cart' . $user['id'];
                $_SESSION[$newUserId] = $res;
                unset($_SESSION[$data['userId']]);
            }
            return $this->responseSuccess($user);
        } else {
            return $this->responseError('User not found or not register yet');
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        try {
            $check = Cart::where('user_id', $request->user_id)->where('id', $request->id)->first();
            if (!empty($check)) {
                return $this->responseSuccess($check);
            }
            $data = [
                'user_id' => $request->user_id,
                'id' => $request->id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'name' => $request->name,
                'thumbnail_web' => $request->thumbnail_web,
                'format_price' => $request->format_price,
                'total' => $request->price
            ];
            $cart = Cart::insertGetId($data);
            $data2 = Cart::find($cart);
            return $this->responseSuccess($data2);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCart($userId)
    {
        try {
            $getCart = Cart::where('user_id', $userId)->get();
            $items = $this->calculate($getCart);
            return $this->responseSuccess($items);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    public function plus(Request $request)
    {
        try {
            $getCart = Cart::where('id', $request->id)->where('user_id', $request->user_id)->first();
            if (!empty($getCart)) {
                $data['quantity'] = $getCart->quantity + 1;
                Cart::where('id', $request->id)->update($data);
            }
            $getCart = Cart::where('user_id', $request->user_id)->get();
            $items = $this->calculate($getCart);
            return $this->responseSuccess($items);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    public function divide(Request $request)
    {
        try {
            $getCart = Cart::where('id', $request->id)->where('user_id', $request->user_id)->first();
            if (!empty($getCart) && $getCart->quantity > 1) {
                $data['quantity'] = $getCart->quantity - 1;
                Cart::where('id', $request->id)->update($data);
            } else {
                Cart::destroy($request->id);
            }
            $getCart = Cart::where('user_id', $request->user_id)->get();
            $items = $this->calculate($getCart);
            return $this->responseSuccess($items);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            Cart::destroy($request->id);
            $getCart = Cart::where('user_id', $request->user_id)->get();
            $items = $this->calculate($getCart);
            return $this->responseSuccess($items);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param $userId
     * @return array
     */
    private function calculate($getCart)
    {
        $items = [];
        if (!empty($getCart)) {
            $total = [];
            $i = 0;
            $items['cart'] = $getCart->toArray();
            foreach ($getCart as $key => $item) {
                $total[$i] = $item['price'] * $item['quantity'];
                $i++;
            }
            $items['real_total'] = array_sum($total);
            $items['total'] = number_format($items['real_total'], 0, ".", '.');
        }
        return $items;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        try {
            $cartData = Cart::where('user_id', $request->user_id)->get();
            $address = UserAddress::where('default', 1)->first();
            $bill = [
                'user_id' => $request->user_id,
                'total' => $request->real_total,
                'user_address' => $address->id,
                'created_at' => Carbon::now()
            ];

            if(!$request->get('forMe')) {
                $deliverOrder = strtotime($request->get('deliver_order'));
                $bill = [
                    'deliver' => $request->get('deliver'),
                    'deliver_order' => date('Y-m-d', $deliverOrder),
                    'deliver_province' => $request->get('deliver_province'),
                    'deliver_district' => $request->get('deliver_district'),
                    'deliver_ward' => $request->get('deliver_ward'),
                    'deliver_message' => $request->get('deliver_message'),
                ];
            }

            $billId = Bill::insertGetId($bill);
            $i = 0;
            foreach ($cartData as $item) {
                $billDetail[$i] = [
                    'bill_id' => $billId,
                    'medicine_id' => $item['id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'created_at' => Carbon::now()
                ];
                $i++;
            }
            BillDetail::insert($billDetail);
            Cart::where('user_id', $request->user_id)->delete();
            return $this->responseSuccess();
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
