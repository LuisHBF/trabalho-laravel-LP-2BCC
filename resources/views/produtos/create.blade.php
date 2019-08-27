@extends('layout')
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Cadastrar Produto
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
            <form method="post" action="{{ route('produtos.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="nome">Nome do Produto:</label>
                    <input type="text" class="form-control" name="nome" id="nome"/>
                </div>
                <div class="form-group">
                    <label for="estoque">Quantidade em Estoque:</label>
                    <input type="text" id="estoque" class="form-control" name="quantidade"/>
                </div>
                <div class="form-group">
                    <label for="preco">Valor do Produto</label>
                    <input type="text" id="preco" class="form-control" name="valor"/>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                <a href="{{route('produtos.index')}}" class="btn btn-danger">Voltar</a>
            </form>
        </div>
    </div>
@endsection
