@extends('layouts.app')
@section('content')

<div class="row-12 d-flex justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a href="{{route('announcement.one', [$announcement->title, $announcement->id])}}">{{$announcement->title}}</a>
            </div>

            <div class="card-body">
                <div class="d-flex">
                    <div class="col-md-8">
                        {{$announcement->body}}
                    </div>
                    
                    <div class="col-md-4">
                        @foreach ($announcement->images as $image)
                            <div class="d-flex justify-content-center my-2">
                                <?php 

                                    $str = ltrim($image->file, 'public/'); 
                                    $file = "storage/{$str}";
                                    $img = getimagesize($file);
                                    $width = $img[0];
                                    $height = $img[1]; ?>

                                @if ($width > $height)
                                    <img src="{{ $image->getUrl(300, 200) }}" class="rounded" alt="">
                                @else 
                                    <img src="{{ $image->getUrl(200, 300) }}" class="rounded" alt="">
                                @endif
                            </div>
                        @endforeach
                    </div>
                
                </div>

                <div class="col-md-8" style="font-style: italic; margin-top: 100px">
                    <p> {{ __('ui.price') }}: {{$announcement->price}} €</p>
                </div>
                    
                </div>
           

        
            <div class="card-footer d-flex justify-content-between">
                <strong>{{ __('ui.category') }}: <a href="{{route('public.announcements.category',
                [ 
                    $announcement->category->name,
                    $announcement->category->id

                ]) }}"> {{$announcement->category->name}} </a></strong>
                <i> {{$announcement->created_at->format('d/m/Y')}} - {{$announcement->user->name}} </i>
            </div>
        </div>
    </div>
</div>
      

@endsection