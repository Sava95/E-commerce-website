@extends('layouts.app')
@section('content')

<div class="containter">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class='text-white'> {{ __('ui.search_results')}} {{$q}}</h1>
        </div>
    </div>

    @foreach($announcements as $announcement)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$announcement->title}}
                    </div>

                    <div class="card-body">
                        <p> 
                            @foreach($announcement->images as $image)
                                <?php 
                                $str = ltrim($image->file, 'public/'); //deletes public/ from the string
                                $file = "storage/{$str}";
                                $img = getimagesize($file);
                                $width = $img[0];
                                $height = $img[1]; ?>

                                @if ($width > $height)
                                    <img src="{{ $image->getUrl(300, 200) }}" class="rounded float-right" alt="">
                                @else 
                                    <img src="{{ $image->getUrl(200, 300) }}" class="rounded float-right" alt="">
                                @endif
                            @endforeach

                            {{$announcement->body}}
                        </p>
                    </div>
                    <?php $cat =  $announcement->category->name;?>

                    <div class="card-footer d-flex justify-content-between">
                            <strong>{{ __('ui.category') }}: <a href="{{route('public.announcements.category',
                            [ 
                                $announcement->category->name,
                                $announcement->category->id

                            ]) }}">  {{ __("ui.$cat") }} </a></strong>

                        <i> {{$announcement->created_at->format('d/m/Y')}} - {{$announcement->user->name}} </i>
                    </div>
                </div>
            </div>
        </div>
    @endforeach                           
</div>
@endsection