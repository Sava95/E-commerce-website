<!-- Used in the list_of_ads.blade view, the same as details.blade but it shows one picture instead of all of them --> 

<div class="d-flex justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a href="{{route('announcement.one', [$announcement->title, $announcement->id])}}">{{$announcement->title}}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        {{$announcement->body}}
                    </div>
                    <div class="col-md-4 d-flex justify-content-center">
                        <!-- getUrl function takes just one input image, so you have to make a loop or use first() -->
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
                            <img src="{{ $announcement->images->first()->getUrl(200, 300) }}" class="rounded" alt="">
                        @endif
                    </div>
                </div>
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
      