@extends('layouts.app')
@section('content')

<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a href="{{route('announcement.one', [$announcement->title, $announcement->id])}}">{{$announcement->title}}</a>
            </div>
            <div class="card-body">
                <p>
                    <img src='https://via.placeholder.com/300' class='rounded float-right' alt="">
                    {{$announcement->body}}
                </p>
            </div>
            <div class="card-body">
                <p>
                    <img src='https://via.placeholder.com/300' class='rounded float-right' alt="">
                   
                </p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <strong>Category: <a href="{{route('public.announcements.category',
                [ 
                    $announcement->category->name,
                    $announcement->category->id

                ]) }}"> {{$announcement->category->name}} </a></strong>
                <i> {{$announcement->created_at->format('d/m/Y')}} - {{$announcement->user->name}} </i>
            </div>
        </div>
    </div>
</div>
      
    
</div>
@endsection