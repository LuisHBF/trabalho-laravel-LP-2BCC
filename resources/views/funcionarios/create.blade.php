@extends('layout')
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Cadastrar Funcionario
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
            <form method="post" action="{{ route('funcionarios.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="nome">Nome do funcionario:</label>
                    <input type="text" class="form-control" name="nome" id="nome"/>
                </div>
                <div class="form-group">
                    <label for="idade">Idade:</label>
                    <input type="number" id="idade" class="form-control" name="idade"/>
                </div>
                <div class="form-group">
                    <label for="setor">Setor</label>
                    <input type="text" id="setor" class="form-control" name="setor"/>
                </div>
                <div class="form-group">
                    Sexo<br>
                    <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" id="radio1" name="sexo" value="m" checked>Masculino
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" id="radio2" name="sexo" value="f">Feminino
                    </label>
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Alterar funcionario</button>
                <a href="{{route('funcionarios.index')}}" class="btn btn-danger">Voltar</a>
            </form>
        </div>
    </div>
@endsection
