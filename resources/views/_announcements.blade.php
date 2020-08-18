@extends('layouts.app')
@section('content')

<div class="containter">
    <div class="d-flex justify-content-center"> 
        <div class="col-md-8 text-white">
            <?php $cat = $category->name;?>

            <h3> {{ __('ui.for_category') }}: {{ __("ui.$cat") }} </h3>
        </div>
    </div>
    @foreach($announcements as $announcement)
        @include('announcement.one')
    @endforeach

    <div class="row justify-content-center">
        <div class="col-md-8">
             {{ $announcements->links() }}               
        </div>
    </div>

</div>

@endsection