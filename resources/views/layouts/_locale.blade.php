<li class="nav-item">
    <form method="POST" action="{{ route('locale', $lang) }}">
        @csrf
        <button type='submit' class="nav-link" style="background-color:transparent; border:none">
             <span class="flag-icon flag-icon-{{ $nation }}"></span> {{ $nation }}
        </button>
    </form>
</li>