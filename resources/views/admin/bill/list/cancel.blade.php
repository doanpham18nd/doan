@extends('admin.layouts.app')

@section('content')
    <!-- Topbar -->
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Đơn hàng đã hủy</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Ngày đặt hàng</th>
                        <th>Địa chỉ nhận hàng</th>
                        <th>Tổng tiền</th>
                        <th colSpan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1}}</td>
                            <td>{{ $item->user->username }}</td>
                            <td>{{ $item->user->phone }}</td>
                            <td>{{ date_format($item->created_at, '\N\g\à\y d-m-Y H:i:s')}}</td>
                            <td>{{ $item->address->address . ', ' . $item->address->ward_name . ', ' . $item->address->district_name . ', ' . $item->address->province_name }}</td>
                            <td>{{ $item->format_total }}<sup>đ</sup></td>
                            <td><a class="btn btn-primary" href="{{ route('getStatusBill' , $item->id) }}">Chi tiết</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
