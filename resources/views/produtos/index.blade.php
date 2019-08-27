@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
        <a href="{{route('relatorios.produtos')}}" class="btn btn-dark">Relatório</a>
        <a href="{{route('produtos.create')}}" class="btn btn-success">Novo Produto</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Valor</td>
                <td>Qtd. Estoque</td>
                <td colspan="2">Ações</td>
            </tr>
            </thead>
            <tbody>
            @foreach($produtos as $produto)
                <tr style="height: 50px">
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->nome}}</td>
                    <td>R$ {{$produto->valor}}</td>
                    <td>{{$produto->quantidade}}</td>
                    <td>
                        <a href="{{ route('produtos.edit',$produto->id)}}" class="btn btn-primary">Editar</a>

                        <form action="{{ route('produtos.destroy', $produto->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" style="margin-left: 65px; margin-top: -62px;">
                                Deletar
                            </button>
                        </form>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
