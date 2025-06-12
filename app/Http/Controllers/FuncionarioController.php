<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        return Funcionario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:4|max:255',
            'ganho_milheiro' => 'required|numeric|min:0',
        ]);

        $funcionario = Funcionario::create($request->all());

        return response()->json($funcionario, 201);
    }

    public function show($id)
    {
        return Funcionario::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|min:4|max:255',
            'ganho_milheiro' => 'required|numeric|min:0',
        ]);

        $funcionario = Funcionario::findOrFail($id);
        $funcionario->update($request->all());

        return response()->json($funcionario, 200);
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return response()->json(null, 204);
    }
}
