@extends('layouts.app')
@section('content')

<div class="containter">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class='text-white'> {{ __('ui.search_results')}} {{$q}}</h1>
        </div>
    </div>

    @foreach($announcements as $announcement)
        @include('announcement.one')
    @endforeach                           
</div>
@endsection