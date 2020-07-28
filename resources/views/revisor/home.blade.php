@extends('layouts.app')

@section('content')
@if ($announcement)

    <div class="containter" style='margin-left:200px; margin-right:200px'>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Anuncio # {{$announcement->id}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <h5> Usuario </h5>
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
                                <h5> Titulo </h5>
                            </div>
                            <div class="col-md-10"> {{$announcement->title}} </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                <h5> Descripcion </h5>
                            </div>
                            <div class="col-md-10"> {{$announcement->body}} </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                <h5> Imagenes </h5>
                            </div>
                        </div>
                    
                        <div class="row mb-2 d-flex justify-content-start">
                            <div class="col-md-2">
                                <img src='https://via.placeholder.com/150' class='rounded' alt="">
                            </div>
                            <div class="col-md-2">
                                <img src='https://via.placeholder.com/150' class='rounded' alt="">
                            </div>
                        </div>
                        <div class="row mb-2 d-flex justify-content-start">
                            <div class="col-md-2 d-flex justify-content-center">
                                <text> Image 1 </text>
                            </div>
                    
                            <div class="col-md-2 d-flex justify-content-center">
                                <text> Image 2 </text>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-5 mr-5 ml-5">
                            <div class="col-md-6">
                                <form method='POST' action="{{ route('revisor.reject', $announcement->id) }}">
                                    @csrf
                                    <div class='d-flex justify-content-center'>
                                        <button type='submit' class='btn btn-danger'> Reject </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6 text-right">
                                <form method='POST' action="{{ route('revisor.accept', $announcement->id) }}">
                                    @csrf
                                    <div class='d-flex justify-content-center'>
                                        <button type='submit' class='btn btn-success'> Accept </button>
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

    <h3 class="text-center"> no hay anuncios para revisar </h3> 

@endif

@endsection