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

            <form action="{{ route('search') }}" method="GET" class="mb-3 mt-3">
                <input type="text" name="q" style="width:700px; height: 37.91px" placeholder="{{ __('ui.search') }}">
                <button class="btn btn-info" type="submit">{{ __('ui.search') }}</button>
            </form>
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