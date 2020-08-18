@extends('layouts.app')

@section('content')
@if ($announcement)

    <div class="containter" style='margin-left:200px; margin-right:200px'>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('ui.ad') }} # {{$announcement->id}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <h5> {{ __('ui.user') }} </h5>
                            </div>
                            <div class="col-md-10">
                                # {{ $announcement->user->id }},
                                {{ $announcement->user->name }},
                                {{ $announcement->user->email }},
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                <h5> {{ __('ui.title') }} </h5>
                            </div>
                            <div class="col-md-10"> {{$announcement->title}} </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                <h5> {{ __('ui.description') }} </h5>
                            </div>
                            <div class="col-md-10"> {{$announcement->body}} </div>
                        </div>

                        <hr>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <h5> {{ __('ui.price') }} </h5>
                            </div>
                            <div class="col-md-10"> {{$announcement->price}} €</div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <h5> {{ __('ui.img') }} </h5>
                            </div>
                        </div>

                        <div class="d-flex">
                            @foreach ($announcement->images as $image)
                                <?php 

                                    $str = ltrim($image->file, 'public/'); //deletes public/ from the string
                                    $file = "storage/{$str}";
                                    $img = getimagesize($file);
                                    $width = $img[0];
                                    $height = $img[1]; ?>

                                @if ($width > $height)
                                    <div class="col-md-4">
                                        <img src="{{ $image->getUrl(300, 200) }}" class="rounded" alt="">
                                    </div>   
                                @else 
                                    <div class="col-md-4">
                                        <img src="{{ $image->getUrl(200, 300) }}" class="rounded" alt="">
                                    </div>
                                    
                                @endif
                            @endforeach
                        </div>

                        <div class="row justify-content-center mt-5 mr-5 ml-5">
                            <div class="col-md-6">
                                <form method='POST' action="{{ route('revisor.reject', $announcement->id) }}">
                                    @csrf
                                    <div class='d-flex justify-content-center'>
                                        <button type='submit' class='btn btn-danger'> {{ __('ui.reject') }} </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6 text-right">
                                <form method='POST' action="{{ route('revisor.accept', $announcement->id) }}">
                                    @csrf
                                    <div class='d-flex justify-content-center'>
                                        <button type='submit' class='btn btn-success'> {{ __('ui.accept') }} </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


@else 

    <h3 class="text-center" style="color:white"> {{ __('ui.revisor_message') }} </h3> 

@endif

@endsection