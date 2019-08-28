<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Produto;
use Illuminate\Http\Request;
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
}
