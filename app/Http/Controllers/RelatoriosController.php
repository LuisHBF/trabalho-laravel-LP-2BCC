<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RelatoriosController extends Controller
{

    public function produtos(){
        $produtos = Produto::all();
        foreach ($produtos as $produto){
            $produto->lucro = $produto->quantidade * $produto->valor;
        }
        $data = ['produtos' => $produtos];
        $pdf = PDF::loadView('relatorios/produtos', $data)->setPaper('a4','landscape');

        return $pdf->stream('produtos.pdf');
    }

    public function funcionarios(){
        $funcionarios = Funcionario::all();
        $informacoes = [
            'qtdMasculino' => 0,
            'qtdFeminino' => 0,
            'mediaIdades' => 0
        ];
        foreach($funcionarios as $funcionario){
            if($funcionario->sexo == 'm'){
                $funcionario->sexo = 'Masculino';
                $informacoes['qtdMasculino']++;
            } else {
                $funcionario->sexo = 'Feminino';
                $informacoes['qtdFeminino']++;
            }
            $informacoes['mediaIdades'] += $funcionario->idade;
        }

        $informacoes['mediaIdades'] = $informacoes['mediaIdades'] / count($funcionarios);
        $data = ['funcionarios' => $funcionarios, 'informacoes' => $informacoes];
        $pdf = PDF::loadView('/relatorios/funcionarios',$data)->setPaper('a4','landscape');
        return $pdf->stream('funcionarios.pdf');
    }

    public function vendas($id){
        $funcionario = Funcionario::find($id)->nome;
        $vendas = DB::select(
            DB::raw('SELECT v.id as id_venda,
                        v.data,   
                        (SELECT nome FROM produtos WHERE id = vhp.id_produto) AS produto, 
                        vhp.quantidade FROM vendas v
                        JOIN vendashasprodutos vhp ON(v.id = vhp.id_venda) 
                        WHERE v.id_funcionario = :id'), ['id' => $id]);

        $data = ['vendas' => $vendas,'funcionario' => $funcionario];
        $pdf = PDF::loadView('/relatorios/vendas',$data)->setPaper('a4','landscape');
        return $pdf->stream('vendas.pdf');
    }
}
