Site da aplicação
@auth
    {{Auth::user()->name}}{{-- Disponivel somente quando o usuario esta autenticado. --}}
    @else
        <h1>Não autenticado</h1>
@endauth
@guest
    <h1>Não autenticado</h1>
    @else
        <h1>Autenticado</h1>
@endguest