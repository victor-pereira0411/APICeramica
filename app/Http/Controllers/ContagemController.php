<?php

namespace App\Http\Controllers;

use App\Models\Producao;
use App\Models\Funcionario;

class ContagemController extends Controller
{
    public function contagens()
    {
        return response()->json([
            'Producaos' => Producao::count(),
            'Funcionarios' => Funcionario::count(),
        ]);
    }
}
