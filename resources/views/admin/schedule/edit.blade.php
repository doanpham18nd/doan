@extends('admin.layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">{{ $scheduleData['title'] }}</h1>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('scheduleEditPost', $scheduleData['id'])}}" method="post">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-4 py-3">
                            <label htmlFor="name">Tên lịch trình</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ $scheduleData['title'] }}"/>
                        </div>

                        <div class="mb-4 py-3">
                            <label htmlFor="">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnailUpdate"
                                   name="thumbnailUpdate"
                                   />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-4 py-3 ">
                            <img class="img-thumbnail" src="{{$scheduleData['thumbnail']}}" style="width: 120px"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-4 py-3">
                            <label htmlFor="editor1">Nội dung tóm tắt</label>
                            <textarea class="form-control" name="short_content" rows="5">{{ $scheduleData['short_content'] }}</textarea>
                        </div>
                        <div id="schedule_content">

                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary ">Cập nhật</button>
                    </div>
                </div>
                <input type="hidden" value="{{$scheduleData['id']}}" name="id">
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let scheduleContents = {!! json_encode($scheduleData['schedule_contents']) !!};
    </script>
    <script src="{{ asset('js/scheduleContent.js') }}"></script>
@endsection
