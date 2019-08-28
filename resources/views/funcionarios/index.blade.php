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
        <a href="{{route('relatorios.funcionarios')}}" class="btn btn-dark" target="_blank">Relatório</a>
        <a href="{{route('funcionarios.create')}}" class="btn btn-success">Novo Funcionario</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Idade</td>
                <td>Setor</td>
                <td>Sexo</td>
                <td colspan="2">Ações</td>
            </tr>
            </thead>
            <tbody>
            @foreach($funcionarios as $funcionario)
                <tr style="height: 50px">
                    <td>{{$funcionario->id}}</td>
                    <td>{{$funcionario->nome}}</td>
                    <td>{{$funcionario->idade}}</td>
                    <td>{{$funcionario->setor}}</td>
                    <td>
                        @if($funcionario->sexo == 'm')
                            Masculino
                        @else
                            Feminino
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('funcionarios.edit',$funcionario->id)}}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('funcionarios.destroy', $funcionario->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" style="margin-left: 65px; margin-top: -62px">
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
