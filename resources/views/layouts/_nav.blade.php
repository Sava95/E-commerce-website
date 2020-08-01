<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Wallapop') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a id="categoriesDropDown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> {{ __('ui.categories') }} <span class='caret'> </span> </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="categoriesDropDown">
                        @foreach ($categories as $category)
                        <a 
                            class="nav-link" 
                            href="{{route('public.announcements.category',
                                [ 
                                   $category->name,
                                   $category->id

                                ]) }}"> {{$category->name}}
                        </a>
                        @endforeach
                    </div>
                </li>           

                <li class="d-flex nav-item align-items-center ml-2 mr-2">
                    <a class="nav_link" href="{{route('announcement.new')}}"> {{ __('ui.new_ad') }} </a> 
                </li>   
        
                                    
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                @if (Auth::user()->is_revisor)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('revisor.home') }}">
                        {{ __('ui.revisor') }}
                        <span class="badge badge-pill badge-warning">
                            {{\App\Announcement::ToBeRevisionedCount() }}
                        </span>
                    </a>
                </li>
                @endif

                <div class="dropdown">
                    <a id="categoriesDropDown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> {{ __('ui.lang') }} <span class='caret'> </span> </a>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li class='dropdown-item'>
                            @include('layouts._locale', ['lang' => 'es', 'nation' => 'es'])
                        </li>
                        <li class='dropdown-item'>
                            @include('layouts._locale', ['lang' => 'it', 'nation' => 'it'])
                        </li>
                        <li class='dropdown-item'>
                            @include('layouts._locale', ['lang' => 'gb', 'nation' => 'gb'])
                        </li>
                    </div>
                </div>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>