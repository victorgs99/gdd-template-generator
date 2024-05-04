<header class="container-fluid d-flex flex-row justify-content-between align-items-center _divisor py-3">
    <a class="ms-3" href="{{ route('index') }}"><img class="_imgLogoBoton" src="{{ url('/img/logo-boton.png') }}" alt="Boton inicio"></a>
    <div class="d-flex flex-row column-gap-3">
        @if(Route::has('login'))
            @auth
                <a class="btn _logRegBtn" href="{{ route('carga-perfil', ['usuario'=>Auth::user()->name]) }}">{{Auth::user()->name}}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-secondary" href="{{route('logout')}}" onclick="event.preventDefault();this.closest('form').submit();">Cerrar sesión</button>
                </form>
            @else    
                <a class="btn _logRegBtn" href="{{ route('login') }}">Iniciar sesión</a>
                <a class="btn _logRegBtn" href="{{ route('register') }}">Registrarse</a>
            @endauth
        @endif
    </div>
</header>