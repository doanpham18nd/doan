@extends('admin.layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Danh sách bài viết</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Thumbnail</th>
                        <th>Short content</th>
                        <th colSpan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($arc as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td><img src="{{$item->thumbnail_web}}" style="width: 200px"></td>
                            <td>{{ $item->short_content }}</td>
                            <td><a class="btn btn-primary" href="{{route('ArticleEdit', $item->id)}}">Sửa</a></td>
                            <td><a class="btn btn-danger" href="{{route('ArticleDelete', $item->id)}}">Xóa</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="float-right">
                {{ $arc->links() }}
            </div>
        </div>
    </div>
@endsection
