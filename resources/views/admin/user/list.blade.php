@extends('admin.layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="new-chat">
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/newChat.js') }}"></script>
@endsection
