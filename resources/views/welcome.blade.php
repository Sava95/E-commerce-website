@extends('layouts.app')
@section('content')

<!-- Page Content -->
<div class="container">
  <!-- Header -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" >
      <ol class="carousel-indicators" style="height: 14px">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
      </ol>

      <div class="carousel-item active">
        <header class="jumbotron jumb_1" style="padding-top: 30px">
          <h1 class="display-3 text-dark" style="margin-bottom: 1px"> Welcome to Badabum! </h1>
          <p class="lead text-dark"> The biggest online shopping website in the World! Everything you need all in one place. Over 8 million articals for you to choose from! What are you waiting for?!</p>

          <a href="{{url('/')}}" class="btn btn-primary btn-lg" style="margin-top: 120px"> Call to action!</a>
        </header>
      </div>

      <div class="carousel-item">
        <header class="jumbotron jumb_3">
          <h1 class="display-4 text-white">Dive into the wild</h1>
          <p class="lead" style="color:#f2f2f2;  font-size: 22px;"> Your next adventure awaits you! </p>

          <a href="{{url('/category/camp/9/announcements')}}" class="btn btn-primary btn-lg" style="margin-top: 123px"> Camping Gear </a>
        </header>
      </div>

      <div class="carousel-item ">
        <header class="jumbotron jumb_2" style="padding-top: 40px">
          <h1 class="display-4 text-dark" style="margin-bottom: 0px"> Refresh your look</h1>
          <p class="lead text-dark" style="font-size: 22px; padding-left: 40px"> A style for every story </p>

          <a href="{{url('/category/clothing/1/announcements')}}" class="btn btn-primary btn-lg" style="margin-top: 156px" > Clothing </a>
        </header>
      </div>

      <div class="carousel-item">
        <header class="jumbotron jumb_5">
          <h1 class="display-4" style="color:#f2f2f2"> Let the Music Speak </h1>
          <p class="lead" style="color:#f2f2f2;  font-size: 22px;"> Keep on rocking with the newest collection of instruments </p>

          <a href="{{url('category/music/5/announcements')}}" class="btn btn-primary btn-lg" style="margin-top: 123px"> Music instruments </a>
        </header>
      </div>
      
      <div class="carousel-item">
        <header class="jumbotron jumb_4" style="padding-top: 40px" >
          <h1 class="display-4 text-dark" style="margin-bottom: 0px"> Furnish Your Life</h1>
          <p class="lead text-dark" style="font-size: 22px; padding-left: 40px"> For your dream home </p>

          <a href="{{url('/category/furniture/7/announcements')}}" class="btn btn-primary btn-lg" style="margin-top: 156px"> Furniture </a>
        </header>
      </div>
  
    </div>

    <a class="carousel-control-prev" style="height: 300px" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" style="margin-top:130px" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>

  <!-- Page Features -->

  <div id='myCarousel_2' class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" >
      <div class="carousel-item active">
        <div class="containter">
          <div class="row mx-3">

            @foreach ($carousel_1 as $announcement)
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                
                <?php 
                  $str = ltrim($announcement->images->first()->file, 'public/'); //deletes public/ from the string
                  $file = "storage/{$str}";
                  $img = getimagesize($file);
                  $width = $img[0];
                  $height = $img[1]; ?>
                  
                  @if (is_null($announcement->images->first()))
                      <img src="http://placehold.it/300x300" alt="">
                  @elseif ($width > $height)
                      <img src="{{ $announcement->images->first()->getUrl(300, 200) }}" class="rounded" alt="">
                  @else 
                    <div class="d-flex h-50 justify-content-center">
                      <img src="{{ $announcement->images->first()->getUrl(200, 300) }}" class="rounded" alt="">
                    </div>
                  @endif                
                  
                  <div class="card-body">
                    <a href="{{route('announcement.one', [$announcement->title, $announcement->id])}}">
                      {{ \Illuminate\Support\Str::limit($announcement->title, 30, '...') }} </a>
                      
                    <p class="card-text"> {{ \Illuminate\Support\Str::limit($announcement->body, 100, '...') }} </p>
                  </div>
                 
                </div>
              </div>
            @endforeach
            
          </div>
        </div>

      </div>

      <div class="carousel-item">
        <div class="containter">
          <div class="row mx-3">

            @foreach ($carousel_2 as $announcement)
                <div class="col-lg-3 col-md-6 mb-4">
                  <div class="card h-100">

                  <?php 
                  $str = ltrim($announcement->images->first()->file, 'public/'); //deletes public/ from the string
                  $file = "storage/{$str}";
                  $img = getimagesize($file);
                  $width = $img[0];
                  $height = $img[1]; ?>
                  
                  
                    @if (is_null($announcement->images->first()))
                        <img src="http://placehold.it/300x300" alt="">
                    @elseif ($width > $height)
                        <img src="{{ $announcement->images->first()->getUrl(300, 200) }}" class="rounded" alt="">
                    @else 
                      <div class="d-flex h-50 justify-content-center">
                        <img src="{{ $announcement->images->first()->getUrl(200, 300) }}" class="rounded" alt="">
                      </div>
                    @endif       

                    <div class="card-body">
                      <a href="{{route('announcement.one', [$announcement->title, $announcement->id])}}">
                      {{ \Illuminate\Support\Str::limit($announcement->title, 30, '...') }} </a>
                     

                      <p class="card-text">{{ \Illuminate\Support\Str::limit($announcement->body, 100, '...') }}</p>
                    </div>
                   
                  </div>
                </div>
              @endforeach

          </div>
        </div>

      </div>
    </div>
    
    <a class="carousel-control-prev d-flex justify-content-start" style="width: 40px " href="#myCarousel_2" 
       role="button" data-slide="prev">

      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next d-flex justify-content-end" style="width: 40px" href="#myCarousel_2" 
       role="button" data-slide="next">

      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>
 

</div>
<!-- /.container -->



@endsection
