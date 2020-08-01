<div class="row justify-content-center mb-5">
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
                    <div class="col-md-4">
                            <div class="col-md-4 my-3">
                                    <div class="row md-2">
                                        <div class="col-md-4">
                                            <img src="{{ $announcement->images->first()->getUrl(300, 150) }}" class="rounded" alt=""> 
                                        </div>   
                                    </div>
                            </div>
                    </div>
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
      