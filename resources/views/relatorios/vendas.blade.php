<!DOCTYPE html>
<html>
<head>
    <title>Produtos</title>
</head>
<style>
</style>
<body>
<div style="width: 1030px">

    <h1 style="text-align: center">Vendas de {{$funcionario}}</h1>
    <br>
    <h3 style="">Total de vendas: {{count($vendas)}}</h3>

    @if(count($vendas) > 0)
        <?php
        /** @var mixed $vendas */
        $vendaAtual = $vendas[0];
        ?>
            <p>Código da venda: {{$vendaAtual->id_venda}} - Data: {{$vendaAtual->data}}</p>
            <table style="width: 1030px; border: 1px solid black; text-align: center">
                <tr>
                    <td>Produto</td>
                    <td>Quantidade</td>
                </tr>

                @foreach($vendas as $venda)
                    @if($venda->id_venda != $vendaAtual->id_venda)
            </table>
            <br><br>
            <p>Código da venda: {{$venda->id_venda}} - Data: {{$venda->data}}</p>
            <table style="width: 1030px; border: 1px solid black; text-align: center">
                <tr>
                    <td>Produto</td>
                    <td>Quantidade</td>
                </tr>
                <tr>
                    <td>{{$venda->produto}}</td>
                    <td>{{$venda->quantidade}}</td>
                </tr>
                @else
                    <tr>
                        <td>{{$venda->produto}}</td>
                        <td>{{$venda->quantidade}}</td>
                    </tr>
                @endif
                <?php
                /** @var mixed $venda */
                $vendaAtual = $venda;
                ?>
                @endforeach;

            </table>
    @else
        <h3 style="text-align: center"> <br> Esse funcionário ainda não possui vendas!</h3>
    @endif

    <hr>
    <p style="text-align: center">2019 - Luizão</p>


</div>
</body>
</html>
