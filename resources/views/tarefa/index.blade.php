@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefas <a href="{{route('tarefa.create')}}" class="float-right">Novo</a></div>
                    <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data limite conclusão</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tarefas as $tarefa)
                                <tr>
                                    <th scope="row">{{$tarefa->id}}</th>
                                    <td>{{$tarefa->tarefa}}</td>
                                    <td>{{date('d/m/Y', strtotime($tarefa->data_limite_conclusao))}}</td>
                                    <td><a href="{{route('tarefa.edit', ['tarefa' => $tarefa])}}">Editar</a></td>
                                    <td>
                                        <form id="form_{{$tarefa->id}}" action="{{route('tarefa.destroy', ['tarefa' => $tarefa])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit();">Excluir</a>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    {{'Você não tem tarefas cadastradas'}}
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{$tarefas->links()}} --}}
                    <nav>
                        {{-- Caso, ocorra problema na navegação eu posso criar o próprio, como abaixo, esses métodos estão disponiveis somente  para o paginate no controlador--}}
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{$tarefas->previousPageUrl()}}">Voltar</a></li>
                            {{--  lastPage: pega a quantidade de páginas totais. --}}
                            @for($i = 1; $i <= $tarefas->lastPage(); $i++)
                                {{-- $tarefas->url() vai pega a url da pagina e de acordo com o nosso loop --}}
                                <li class="page-item {{$tarefas->currentPage() == $i ? 'active' : ''}}">
                                    {{-- Colocando uma condicional de que se a pagina atual for igual a $i, retornamos 'active' para destacar o link --}}
                                    <a class="page-link" href="{{$tarefas->url($i)}}">{{$i}}</a>
                                </li>
                            @endfor
                            <li class="page-item"><a class="page-link" href="{{$tarefas->nextPageUrl()}}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection