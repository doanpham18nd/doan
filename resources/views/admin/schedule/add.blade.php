@extends('admin.layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Thêm mới lịch trình</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <form encType="multipart/form-data" action="{{route('scheduleAddPost')}}" method="post">
                            <div class="box-body">
                                <div class="form-group col-xs-6">
                                    <label htmlFor="exampleInputEmail1">Tiêu đề</label>
                                    <input type="text" class="form-control" id="title" name="title"/>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label htmlFor="">Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail"/>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label htmlFor="editor1">Nội dung tóm tắt</label>
                                    <textarea class="form-control" name="short_content" rows="5"></textarea>
                                </div>
                            </div>
                            <div id="schedule_content">
                            </div>
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary ">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let scheduleContents = [];
    </script>
    <script src="{{ asset('js/scheduleContent.js') }}"></script>
@endsection