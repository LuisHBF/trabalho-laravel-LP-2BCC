<!-- edit.blade.php -->

@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Produto ({{$produto->nome}})
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('produtos.update', $produto->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Nome do Produto:</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="{{$produto->nome}}"/>
                </div>
                <div class="form-group">
                    <label for="estoque">Quantidade em Estoque:</label>
                    <input type="text" id="estoque" class="form-control" name="quantidade" value="{{$produto->quantidade}}"/>
                </div>
                <div class="form-group">
                    <label for="preco">Valor do Produto</label>
                    <input type="text" id="preco" class="form-control" name="valor"  value="{{$produto->valor}}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar Produto</button>
                <a href="{{route('produtos.index')}}" class="btn btn-danger">Voltar</a>

            </form>
        </div>
    </div>
@endsection
