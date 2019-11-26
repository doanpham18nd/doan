@extends('admin.layouts.app')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Thêm mới thuốc</h1>
        </div>
        <div class="card-body">
            <form encType="multipart/form-data" method="post" action="{{route('medicineAddPost')}}">
                <div class="col-lg-12">
                    <div class="mb-4 py-3">
                        <label htmlFor="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name"
                        />
                    </div>

                    <div class="mb-4 py-3">
                        <label htmlFor="">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail"
                               name="thumbnail"/>
                    </div>

                    <div class="mb-4 py-3">
                        <label htmlFor="exampleInputEmail1">Giá</label>
                        <input type="text" class="form-control" id="price" name="price"/>
                    </div>
                    <div class="mb-4 py-3">
                        <label htmlFor="exampleInputEmail1">Danh mục sản phẩm</label>
                        <select class="form-control" name="category" id="category">
                            <optgroup label="chăm sóc da mặt">
                                @foreach($category1 as $category)
                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="chăm sóc body">
                                @foreach($category2 as $category)
                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="viên uống bổ sung">
                                @foreach($category3 as $category)
                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">

                    <div class="mb-4 py-3 ">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-4 py-3">
                        <label htmlFor="editor1">Nội dung tóm tắt</label>
                        <textarea class="form-control" name="short_content" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-4 py-3">
                        <label>Mô tả sản phẩm</label>
                        <textarea id="editor1" name="content" rows="5"></textarea>

                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-primary ">Thêm mới</button>
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
