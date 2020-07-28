@extends('layouts.app')
@section('content')

<div class="containter">
    <div class="row justify-content-center"> 
        <div class="col-md-8">
            <h1> Anuncios por categoria : {{ $category->name }} </h1>
        </div>
    </div>
    @foreach($announcements as $announcement)
        @include('announcement\one')
    @endforeach

    <div class="row justify-content-center">
        <div class="col-md-8">
             {{ $announcements->links() }}               
        </div>
    </div>

</div>

@endsection