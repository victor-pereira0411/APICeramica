<?php

namespace App\Http\Controllers;

use App\Models\Producao;
use Illuminate\Http\Request;

class ProducaoController extends Controller
{
    public function index()
    {
        return Producao::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'data_producao' => 'required|date',
            'milheiros_produzidos' => 'required|integer|min:0',
        ]);

        $producao = Producao::create($request->all());

        return response()->json($producao, 201);
    }

    public function show($id)
    {
        return Producao::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'data_producao' => 'required|date',
            'milheiros_produzidos' => 'required|integer|min:0',
        ]);

        $producao = Producao::findOrFail($id);
        $producao->update($request->all());

        return response()->json($producao, 200);
    }

    public function destroy($id)
    {
        $producao = Producao::findOrFail($id);
        $producao->delete();

        return response()->json(null, 204);
    }
}
