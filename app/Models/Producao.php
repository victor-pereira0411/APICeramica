<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producao extends Model
{
    use HasFactory;

    protected $table = 'producoes';

    protected $fillable = [
        'data_producao',
        'milheiros_produzidos',
    ];

    protected $casts = [
        'data_producao' => 'date',
    ];
}
