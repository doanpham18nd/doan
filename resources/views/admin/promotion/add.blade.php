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
            <h1 class="m-0 font-weight-bold text-primary">Thêm mới khuyến mãi</h1>
        </div>
        <div class="card-body">
            <form encType="multipart/form-data" action="{{route('promotionAddPost')}}" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Ngày bắt đầu</label>
                            <input type="text" class="form-control" id="datepicker2" data-date-format="dd-mm-yyyy" name="start_date"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Ngày kết thúc</label>
                            <input type="text" class="form-control" id="datepicker" data-date-format="dd-mm-yyyy" name="end_date"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-4 py-3">
                            <label htmlFor="">Ảnh slide</label>
                            <input type="file" class="form-control" id="slide_image"
                                   name="slide_image"/>
                        </div>
                        <label htmlFor="">Ảnh content</label>
                        <input type="file" class="form-control" id="content_image"
                               name="content_image"/>
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
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
        $("#datepicker2").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    </script>
@endsection
