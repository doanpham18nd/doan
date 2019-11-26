@extends('admin.layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">{{ $arc->title }}</h1>
        </div>
        <div class="card-body">
            <form encType="multipart/form-data" action="{{route('ArticleEditPost', $arc->id)}}" method="post">
                <div class="row">
                    <input name="id" type="hidden" value="{{ $arc->id }}">
                    <div class="col-lg-12">
                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" value="{{$arc->title}}" name="title"/>
                        </div>

                        <div class="mb-4 py-3">
                            <label htmlFor="">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnailUpdate"
                                   name="thumbnailUpdate"/>
                        </div>

                        <div class="mb-4 py-3">
                            <label htmlFor="editor1">Nội dung tóm tắt</label>
                            <textarea class="form-control" name="short_content" rows="5">{{$arc->short_content}}</textarea>
                        </div>
                        <div class="mb-4 py-3">
                            <label htmlFor="editor1">Nội dung bài viết</label>
                            <textarea id="editor1" class="form-control" name="content" rows="5">{{$arc->content}}</textarea>

                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary ">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        CKEDITOR.replace('editor1');
        $('#category').select2();
    </script>
@endsection
