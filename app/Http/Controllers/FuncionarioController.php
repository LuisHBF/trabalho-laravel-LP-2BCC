<?php

namespace App\Http\Controllers;

use App\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('/funcionarios/index',compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funcionarios/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $funcionarioPost = $request->validate([
            'nome' => 'required|max:255',
            'idade' => 'required|numeric|min:18|max:110',
            'setor' => 'required|max:255',
            'sexo' => 'required|max:1'
        ]);
        if($request->sexo != 'm' && $request->sexo != 'f'){
            return redirect('/funcionarios')->with('error','Preencha os campos corretamente!');
        }
        Funcionario::create($funcionarioPost);
        return redirect('/funcionarios')->with('success','Funcionario cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionarios/edit',compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $funcionarioPost = $request->validate([
            'nome' => 'required|max:255',
            'idade' => 'required|numeric|min:18|max:110',
            'setor' => 'required|max:255',
            'sexo' => 'required|max:1'
        ]);

        Funcionario::whereId($id)->update($funcionarioPost);

        return redirect('/funcionarios')->with('success','Funcionario atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return redirect('/funcionarios')->with('success', 'Funcionario deletado com sucesso!');
    }
}
