<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function create(){
        return view('produtos/create');
    }

    public function store(Request $request){
        $produtoPost = $request->validate([
            'nome' => 'required|max:255',
            'quantidade' => 'required|numeric',
            'valor' => 'required|numeric'
        ]);

        $produto = Produto::create($produtoPost);
        return redirect('/produtos')->with('success','Produto cadastrado com sucesso!');

    }

    public function index(){
        $produtos = Produto::all()->where('excluido','=','0');
        return view('/produtos/index',compact('produtos'));
    }

    public function edit($id){
        $produto = Produto::findOrFail($id);
        return view('/produtos/edit', compact('produto'));
    }

    public function update(Request $request, $id){
        $produtoPost = $request->validate([
            'nome' => 'required|max:255',
            'quantidade' => 'required|numeric',
            'valor' => 'required|numeric'
        ]);

        Produto::whereId($id)->update($produtoPost);

        return redirect('/produtos')->with('success','Produto atualizado com sucesso!');
    }

    public function destroy($id){
        $produto = Produto::findOrFail($id);
        $produto->excluido = 1;
        $produto->save();

        return redirect('/produtos')->with('success', 'Produto deletado com sucesso!');
    }
}
