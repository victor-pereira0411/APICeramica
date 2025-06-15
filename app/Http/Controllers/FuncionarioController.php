<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 

class FuncionarioController extends Controller
{
    public function index(): JsonResponse
{
    $funcionarios = Funcionario::orderBy('id', 'asc')->get()->map(function ($funcionario) {
        return [
            'id' => $funcionario->id,
            'nome' => $funcionario->nome,
            'ganho_milheiro' => $funcionario->ganho_milheiro,
            'created_at' => $funcionario->created_at,
            'updated_at' => $funcionario->updated_at,
        ];
    });

    return response()->json([
        'message' => $funcionarios->isEmpty()
            ? 'Nenhum funcionário cadastrado.'
            : 'Funcionários encontrados com sucesso.',
        'data' => $funcionarios,
    ], 200);
}



    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:4|max:255',
            'ganho_milheiro' => 'required|numeric|min:0',
        ]);

        $funcionario = Funcionario::create($request->all());

        return response()->json([
            'message' => 'Funcionário criado com sucesso.',
            'data' => $funcionario
        ], 201);
    }

    public function show($id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }

        return response()->json($funcionario, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|min:4|max:255',
            'ganho_milheiro' => 'required|numeric|min:0',
        ]);

        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }

        $funcionario->update($request->all());

        return response()->json([
            'message' => 'Funcionário atualizado com sucesso.',
            'data' => $funcionario
        ], 200);
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado.'], 404);
        }

        $funcionario->delete();

        return response()->json(['message' => 'Funcionário excluído com sucesso.'], 200);
    }
}
