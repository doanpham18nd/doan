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
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Danh sách lịch trình</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên lịch trình</th>
                        <th>Thumbnail</th>
                        <th>Short content</th>
                        <th colSpan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>HOHO</td>
                        <td>HIH</td>
                        <td>Content</td>
                        <td>Sửa</td>
                        <td>Xóa</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
