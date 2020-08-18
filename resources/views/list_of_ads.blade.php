@extends('layouts.app')
@section('content')

@if (session('announcement.create.success'))
    <div class="alert alert-success">
        {{ __('ui.correct_message') }}
    </div>
@endif

@if (session('access.denied.revisor.only'))
    <div class="alert alert-danger">
        {{ __('ui.error_message') }}
    </div>
@endif

<div class="containter">
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <h1 class='text-white'> {{ __('ui.welcome') }} </h1>
        </div>
    </div>

    @foreach($announcements as $announcement)
        @include('announcement.one')
    @endforeach

    <div class="d-flex justify-content-center">
        <div class="col-md-8">
             {{ $announcements->links() }}               
        </div>
    </div>

    
</div>

@endsection