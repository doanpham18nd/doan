@extends('admin.layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Danh sách thuốc</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr class="table-primary">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Thumbnail</th>
                        <th>Mô tả</th>
                        <th>Category</th>
                        <th colSpan={2}>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medicines as $medicine)
                        <tr>
                            <td>{{ $medicine['id'] }}</td>
                            <td>{{ $medicine['name'] }}</td>
                            <td><img class="img-thumbnail" style="width: 200px; height: 200px; border: none!important;" src="{{ $medicine['thumbnail_app'] }}"></td>
                            <td>{{ $medicine['short_content'] }}</td>
                            <td><a href="{{ route('medicineEdit', $medicine['id']) }}" class="btn btn-primary">Sửa</a></td>
                            <td><a href="{{ route('medicineDelete', $medicine['id']) }}" class="btn btn-danger">Xóa</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="float-right">
                {{ $medicines->links() }}
            </div>
        </div>
    </div>
@endsection
