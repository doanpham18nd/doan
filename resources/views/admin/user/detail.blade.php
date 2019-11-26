@extends('admin.layouts.app')

@section('content')
    <!-- Topbar -->
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="card shadow mb-4">
        <div class="card-header py-3 text-center">
            <h1 class="m-0 font-weight-bold text-primary">{{ $user->username }}</h1>
        </div>
        <div class="card-body">
        </div>
    </div>
@endsection
