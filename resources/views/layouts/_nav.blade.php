<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container" style="margin-left: 180px">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src='/img/BADABUM-logo.png' alt='' style="width: 200px; height:auto;">        
        </a>
        
        <!-- Left Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav">
                @auth
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
                @endauth
            </ui>
        </div>
                
        <!-- Right Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">       
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('ui.login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('ui.register') }}</a>
                        </li>
                    @endif
                @else
                
                    <!-- New Ads -->
                    <li class="d-flex nav-item align-items-center ml-2 mr-2" style="font-size:1rem; font-weight:450">
                        <a class="nav_link" href="{{route('announcement.new')}}"> {{ __('ui.new_ad') }} </a> 
                    </li>
                    
                    <!-- Categories -->
                    <li class="nav-item dropdown">
                        <a id="categoriesDropDown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> {{ __('ui.categories') }} <span class='caret'> </span> </a>

                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="categoriesDropDown">
                            @foreach ($categories as $category)
                            <a 
                                class="nav-link" style="color:black" 
                                href="{{route('public.announcements.category',
                                    [ 
                                        $category->name,
                                        $category->id

                                    ]) }}"> 
                                    
                                    <?php $cat = $category->name;?>
                                    
                                    {{ __("ui.$cat") }}
                            </a>
                            @endforeach
                        </div>
                    </li>    

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

    <!-- Flags -->
        <ul class="navbar-nav">
            <div class="dropdown">
                <a id="categoriesDropDown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> 
                    
                <i class="fas fa-flag" style="padding-right:5px"> </i> 
                
                <?php $locale = App::getLocale(); 

                if ($locale == 'gb')
                    $locale = 'en';

                ?> 

                <text style='text-transform: uppercase;'> {{$locale}} </text>
                    
                </a>
                
    
                <div class="dropdown-menu dropdown-menu-right" style="min-width:140px" aria-labelledby="dropdownMenu2">
                    <li class='dropdown-item'>
                        @include('layouts._locale', ['lang' => 'es', 'nation' => 'Espanol'])
                    </li>
                    <li class='dropdown-item'>
                        @include('layouts._locale', ['lang' => 'it', 'nation' => 'Italiano'])
                    </li>
                    <li class='dropdown-item'>
                        @include('layouts._locale', ['lang' => 'gb', 'nation' => 'English'])
                    </li>
                </div>

            </div>
        </ul>
</nav>