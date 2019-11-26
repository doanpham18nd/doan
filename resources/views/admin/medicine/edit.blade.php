@extends('admin.layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">{{ $symptomData['name'] }}</h1>
        </div>
        <div class="card-body">
            <form encType="multipart/form-data" method="post" action="{{ route('medicineEditPost', $symptomData['id']) }}">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" value="{{$symptomData['name']}}" id="name" name="name"/>
                        </div>

                        <div class="mb-4 py-3">
                            <label htmlFor="">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnailUpdate"
                                   name="thumbnailUpdate"/>
                        </div>

                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Giá</label>
                            <input type="text" class="form-control" id="price" value="{{ $symptomData['price'] }}" name="price"/>
                        </div>
                        <div class="mb-4 py-3">
                            <label htmlFor="exampleInputEmail1">Danh mục sản phẩm</label>
                            <select class="form-control" name="category" id="category1">
                                <optgroup label="chăm sóc da mặt">
                                    @foreach($category1 as $category)
                                        <option
                                        @if($category['id'] == $symptomData['category'])
                                            selected
                                        @endif
                                        value="{{$category['id']}}">{{$category['name']}}
                                        </option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="chăm sóc body">
                                    @foreach($category2 as $category)
                                        <option
                                                @if($category['id'] == $symptomData['category'])
                                                selected
                                                @endif
                                                value="{{$category['id']}}">{{$category['name']}}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="viên uống bổ sung">
                                    @foreach($category3 as $category)
                                        <option
                                                @if($category['id'] == $symptomData['category'])
                                                selected
                                                @endif
                                                value="{{$category['id']}}">{{$category['name']}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="mb-4 py-3 ">
                            <img style="width: 200px;height: 400px" src="{{$symptomData['thumbnail_web']}}"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-4 py-3">
                            <label htmlFor="editor1">Nội dung tóm tắt</label>
                            <textarea class="form-control" name="short_content" rows="5">{{ $symptomData['short_content'] }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-4 py-3">
                            <label htmlFor="editor1">Mô tả sản phẩm</label>
                            <textarea id="editor1" name="content">{{ $symptomData['content'] }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $symptomData['id'] }}">
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
        $('#category1').select2();
    </script>
@endsection
