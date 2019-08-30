<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Produto;
use App\Venda;
use App\VendaHasProdutos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{

    public function index(){
        $produtos = Produto::all();
        $funcionarios = Funcionario::all();
        $data = ['produtos' => $produtos, 'funcionarios' => $funcionarios];
        return view('vendas/create', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'ultimo' => 'required|numeric',
            'funcionario' => 'required|numeric'
        ]);


        $itensOk = [];
        for($i = 1; $i <= $request->ultimo; $i++){
            if(isset($_POST['produto-'.$i])){
                if($_POST['produto-'.$i] > 0){
                    $qtd = Produto::find($i)->quantidade;
                    if($qtd < $_POST['produto-'.$i]){
                        return redirect('/nova-venda')->withErrors(['error' => 'Não é possível vender mais itens do que se tem em estoque!']);
                    }
                    $itemOk = ['id' => $i, 'quantidadeSolicitada' => $_POST['produto-'.$i], 'quantidadeDisponivel' => $qtd];
                    array_push($itensOk,$itemOk);
                }
            }
        }

        if(count($itensOk) < 1){
            return redirect('/nova-venda')->withErrors(['error' => 'Altere a quantidade de pelo menos um item para vende-lo!']);
        }

        $idVenda = Venda::insertGetId(['id_funcionario' => $request->funcionario]);
        foreach($itensOk as $itemOk){
            DB::table('vendashasprodutos')
                ->insert(['id_venda' => $idVenda, 'id_produto' => $itemOk['id'], 'quantidade' => $itemOk['quantidadeSolicitada']]);
            DB::table('produtos')->where('id','=',$itemOk['id'])
                ->update(['quantidade' => $itemOk['quantidadeDisponivel'] - $itemOk['quantidadeSolicitada']]);
        }

        return redirect('/nova-venda')->with('success', 'Venda realizada com sucesso!');
    }
}
