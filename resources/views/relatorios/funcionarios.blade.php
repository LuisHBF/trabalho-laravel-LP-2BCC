<!DOCTYPE html>
<html>
<head>
    <title>Funcionarios</title>
</head>
<style>
    tr{
        border: 1px solid black;
        text-align: center;
        border-bottom: 2px solid black;
    }
</style>
<body>
<div style="width: 1030px">
    <h1 style="text-align: center">Funcionarios Existentes na Base de Dados</h1>
    <br>
    <p style="color: red">Qtd. Funcionarias: {{$informacoes['qtdFeminino']}}</p>
    <p style="color: blue">Qtd. Funcionarios: {{$informacoes['qtdMasculino']}}</p>
    <p>Qtd. Funcionarios totais: {{$informacoes['qtdFeminino'] + $informacoes['qtdMasculino']}}</p>
    <p>Média de idades: {{$informacoes['mediaIdades']}} anos</p>

    <table style="width: 1030px; border: 1px solid black;">
        <tr>
            <td>Codigo</td>
            <td>Nome</td>
            <td>Setor</td>
            <td>Idade</td>
            <td>Sexo</td>
        </tr>
        @foreach($funcionarios as $funcionario)
            <tr>
                <td>{{$funcionario->id}}</td>
                <td>{{$funcionario->nome}}</td>
                <td>{{$funcionario->setor}}</td>
                <td>{{$funcionario->idade}}</td>
                <td>{{$funcionario->sexo}}</td>
            </tr>
        @endforeach;
    </table>
    <br><br>
    <hr>
    <p style="text-align: center">2019 - Luizão</p>


</div>
</body>
</html>
