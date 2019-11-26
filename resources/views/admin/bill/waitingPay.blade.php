@extends('admin.layouts.app')

@section('content')
    <!-- Topbar -->
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center" style="margin-bottom: 50px">
            <h1 class="m-0 font-weight-bold text-primary">Cập nhật đơn hàng</h1>
        </div>
        <div class="card-body">
            <form action="{{route('updateStatusBill', $data->id)}}" method="post">
                <input type="hidden" name="status" value="1">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group col-xs-6">
                                    <h4>Địa chỉ nhận hàng: </h4>
                                    {{$data->user->username}}({{$data->user->phone}}) - {{ $data->address->address . ', ' . $data->address->ward_name . ', ' . $data->address->district_name . ', ' . $data->address->province_name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group col-xs-6">
                            <label htmlFor="exampleInputEmail1">Nhân viên giao hàng:</label>
                            <select id="deliver" class="form-control">
                                <option>Trâm Anh</option>
                                <option>Doãn Hà My</option>
                                <option>Lương Minh Phương</option>
                                <option>Trâm Anh</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->billDetail as $key => $billDetail)
                                    <tr class=" text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td><a href="{{route('medicineEdit', $billDetail->medicine_id)}}">{{ $billDetail->medicine_name }}</a> </td>
                                        <td>{{ $billDetail->format_price }} <sup>đ</sup></td>
                                        <td>{{ $billDetail->quantity }}</td>
                                        <td>{{ number_format(($billDetail->quantity * $billDetail->price), 0, ".", '.' )}} <sup>đ</sup></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="border: none"></td>
                                    <td style="border: none"></td>
                                    <td style="border: none"></td>
                                    <td style="border: none">Tổng tiền:</td>
                                    <td style="border: none">{{ $data->format_total }} <sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td style="border: none"></td>
                                    <td style="border: none"></td>
                                    <td style="border: none"></td>
                                    <td style="border: none"></td>
                                    <td style="border: none"><input type="submit" class="btn btn-primary" value="Cập nhật"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#deliver').select2();
    </script>
@endsection
