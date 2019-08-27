<?php

namespace App\Http\Controllers;

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
}
