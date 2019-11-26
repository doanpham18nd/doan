@extends('admin.layouts.app')

@section('content')
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
                    @php $i = 1 @endphp
                    @foreach($scheduleData as $schedule)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $schedule['title'] }}</td>
                            <td><img class="img-thumbnail" src="{{ $schedule['thumbnail'] }}"></td>
                            <td>{{ $schedule['short_content'] }}</td>
                            <td><a href="{{ route('scheduleEdit', $schedule['id']) }}" class="btn btn-primary">Sửa</a></td>
                            <td><a href="{{ route('scheduleDelete', $schedule['id']) }}" class="btn btn-danger">Xóa</a></td>
                        </tr>
                        @php $i = $i + 1 @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
