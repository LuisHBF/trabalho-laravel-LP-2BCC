@extends('layout')
@section('content')
    <?php
        $funcionarios = $data['funcionarios'];
        $produtos = $data['produtos'];
    ?>
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br/>
    @endif

    <div class="card uper">
        <div class="card-header">
            Cadastrar Venda
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
            <form method="post" action="{{ route('vendas.store') }}">

                <div class="form-group">
                    @csrf
                    <label for="funcionario">Funcionario:</label><br>
                    <select class="form-control selectpicker" name="funcionario"  data-live-search="true">
                        @foreach($funcionarios as $funcionario)
                            <option value="{{$funcionario->id}}">{{$funcionario->nome}}</option>
                        @endforeach;
                    </select>
                </div>
                <div class="form-group">
                    <table class="table text-center" id="produtos">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Quantidade em estoque</th>
                                <th>Quantidade p/ vender</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>{{$produto->id}}</td>
                                    <td>{{$produto->nome}}</td>
                                    <td>{{$produto->quantidade}}</td>
                                    <td>
                                        <input type="number" class="form-control text-center" name="produto-{{$produto->id}}" value="0" max="{{$produto->quantidade}}" min="0">
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar Venda</button>
                <a href="javascript:history.back()" class="btn btn-danger">Voltar</a>
            </form>
        </div>
    </div>

@endsection
