<li class="nav-item">
    <form method="POST" action="{{route('locale', $lang)}}">
        @csrf
        <button type='submit' class="nav-link" style="background-color:transparent; border:none">
            <div class="row">
                <div class="col" style="padding-right:4px">
                    <span class="flag-icon flag-icon-{{ $lang }}"> </span> 
                </div>
                <div class="col" style="padding-left: 0px">
                    <text style="color:black"> {{ $nation }} </text> 
                </div>
            </div>
        </button>
    </form>
</li>
