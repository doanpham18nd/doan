@extends('admin.layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Thêm mới bài viết</h1>
        </div>
        <div class="card-body">
            <form encType="multipart/form-data" action="{{route('ArticleAddPost')}}" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title"/>
                        </div>

                        <div class="mb-4 py-3">
                            <label htmlFor="">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnail"
                                   name="thumbnail"/>
                        </div>

                        <div class="mb-4 py-3">
                            <label htmlFor="editor1">Nội dung tóm tắt</label>
                            <textarea class="form-control" name="short_content" rows="5"></textarea>
                        </div>
                        <div class="mb-4 py-3">
                            <label htmlFor="editor1">Nội dung bài viết</label>
                            <textarea id="editor1" class="form-control" name="content" rows="5"></textarea>

                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary ">Thêm mới</button>
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
