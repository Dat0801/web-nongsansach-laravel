@extends('client.shared.layout')
@section('title', $title)
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $title }}</h1>
    </div>
    <!-- Single Page Header End -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="alert alert-success">{{ $title }}</div>
        </div>
    </div>
@endsection