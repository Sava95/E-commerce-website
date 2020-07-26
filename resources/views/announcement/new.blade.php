@extends('layouts.app')
@section('content')

<div class="containter">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1> Nuevo anuncio </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('announcement.create')}}">
                        @csrf
                        <div class="form-group row">
                            <label for='title' class='col-md-4 col-form-label text-md-right'> Titulo </label>
                            <div class="col-md-6">
                                <input type='text' class="form-control @error('title') is-invalid @enderror" name='title'
                                       value ="{{old('title')}}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role='alert'> <strong>{{$message}}</strong> </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for='body' class='col-md-4 col-form-label text-md-right'> Anuncio </label>
                            <div class="col-md-6">
                                <textarea type='text' class="form-control @error('body') is-invalid @enderror" name='body'
                                       cols='30' rows='10' value ="{{old('body')}}" required > </textarea>

                                @error('body')
                                    <span class="invalid-feedback" role='alert'> <strong>{{$message}}</strong> </span>
                                @enderror
                            </div>
                        </div>
                        <button type='submit'> Crea </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection