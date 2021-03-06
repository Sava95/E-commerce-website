@extends('layouts.app')
@section('content')

<div class="containter">
    <div class="row-12 d-flex justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1> {{ __('ui.new_ad') }} </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('announcement.create')}}">
                        @csrf

                        <input 
                            type="hidden"
                            name="uniqueSecret"
                            value="{{$uniqueSecret}}">

                        <div class="form-group row">
                            <label for='category' class='col-md-4 col-form-label text-md-right'> {{ __('ui.category') }} </label>
                            <div class="col-md-6">
                                <select class='form-control' name='category' id="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(old('category') == $category->id) selected @endif>

                                        <?php $cat = $category->name;?>

                                        {{ __("ui.$cat") }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                @error('category')
                                    <span class="invalid-feedback" role='alert'> <strong>{{$message}}</strong> </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for='title' class='col-md-4 col-form-label text-md-right'> {{ __('ui.title') }}  </label>
                            <div class="col-md-6">
                                <input type='text' class="form-control @error('title') is-invalid @enderror" name='title'
                                       value ="{{old('title')}}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role='alert'> <strong>{{$message}}</strong> </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for='body' class='col-md-4 col-form-label text-md-right'> {{ __('ui.description') }} </label>
                            <div class="col-md-6">
                                <textarea type='text' class="form-control @error('body') is-invalid @enderror" name='body'
                                       cols='30' rows='10' value ="{{old('body')}}" required > </textarea>

                                @error('body')
                                    <span class="invalid-feedback" role='alert'> <strong>{{$message}}</strong> </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for='price' class='col-md-4 col-form-label text-md-right'> {{ __('ui.price') }}  </label>
                            
                            <div class="col-md-2">
                                <input type='text' class="form-control col-md-12 @error('price') is-invalid @enderror" name='price'
                                       value ="{{old('price')}}" required > 

                                @error('price')
                                    <span class="invalid-feedback" role='alert'> <strong>{{$message}}</strong> </span>
                                @enderror
                            </div>

                            <label for='price' class='col-md-2 col-form-label '> € </label>

                        </div>

                        <div class="form-group row">
                            <label for='images' class='col-md-12 col-form-label'> {{ __('ui.img') }} </label>
                            <div class="col-md-12">
                                <div class="dropzone" id='drophere'> </div>
                                
                                @error('images')
                                    <span class="invalid-feedback" role='alert'> <strong>{{$message}}</strong> </span>
                                @enderror
                            </div>
                        </div>
            
                        <button type='submit' class="btn btn-lg btn-primary"> {{ __('ui.create') }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection