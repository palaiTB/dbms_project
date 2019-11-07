@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
</div>
@endsection
