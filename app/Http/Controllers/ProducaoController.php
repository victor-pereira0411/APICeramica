<?php

namespace App\Http\Controllers;

use App\Models\Producao;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProducaoController extends Controller
{
    public function index(): JsonResponse
{
    $producoes = Producao::orderBy('id', 'asc')->get()->map(function ($producao) {
        return [
            'id' => $producao->id,
            'data_producao' => \Carbon\Carbon::parse($producao->data_producao)->format('d/m/Y'),
            'milheiros_produzidos' => $producao->milheiros_produzidos,
            'created_at' => $producao->created_at,
            'updated_at' => $producao->updated_at,
        ];
    });

    return response()->json([
        'message' => 'Produções encontradas com sucesso.',
        'data' => $producoes,
    ], 200);
}




    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'data_producao' => 'required|date',
            'milheiros_produzidos' => 'required|integer|min:0',
        ]);

        $producao = Producao::create($request->all());

        return response()->json([
            'message' => 'Produção criada com sucesso.',
            'data' => $producao,
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $producao = Producao::find($id);

        if (!$producao) {
            return response()->json([
                'message' => 'Produção não encontrada.',
            ], 404);
        }

        return response()->json([
            'message' => 'Produção encontrada.',
            'data' => $producao,
        ], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'data_producao' => 'required|date',
            'milheiros_produzidos' => 'required|integer|min:0',
        ]);

        $producao = Producao::find($id);

        if (!$producao) {
            return response()->json([ 
                'message' => 'Produção não encontrada.',
            ], 404);
        }

        $producao->update($request->all());

        return response()->json([
            'message' => 'Produção atualizada com sucesso.',
            'data' => $producao,
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $producao = Producao::find($id);

        if (!$producao) {
            return response()->json([
                'message' => 'Produção não encontrada.',
            ], 404);
        }

        $producao->delete();

        return response()->json([
            'message' => 'Produção deletada com sucesso.',
        ], 200);
    }
}
