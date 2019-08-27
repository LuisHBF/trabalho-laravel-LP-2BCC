<!DOCTYPE html>
<html>
<head>
    <title>Produtos</title>
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
        <h1 style="text-align: center">Produtos Existentes na Base de Dados</h1>
        <table style="width: 1030px; border: 1px solid black;">
            <tr>
                <td>Codigo</td>
                <td>Nome</td>
                <td>Qtd. Estoque</td>
                <td>Valor</td>
                <td style="color: green">Lucro Possível</td>
            </tr>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->quantidade}}</td>
                    <td>R$ {{$produto->valor}}</td>
                    <td style="color: green">R$ {{$produto->lucro}}</td>
                </tr>
            @endforeach;
        </table>
        <br><br>
        <hr>
     <p style="text-align: center">2019 - Luizão</p>


    </div>
</body>
</html>
