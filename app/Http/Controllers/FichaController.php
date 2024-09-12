<?php

namespace App\Http\Controllers;

use App\Http\Requests\FichaRequest;
use App\Models\Ficha;

class FichaController extends Controller
{
    public function index()
    {
        return response()->json(Ficha::all());
    }

    public function show($numero)
    {
        $ficha = Ficha::where('numero', '=', $numero)->first();
        if (!$ficha) {
            return response()->json(['error' => 'No se encontró la ficha'], 404);
        }
        return response()->json($ficha);
    }

    public function store(FichaRequest $request)
    {
        $dataFicha = $request->validated();
        $ficha = new Ficha($dataFicha);
        $ficha->save();
        return response()->json([
            'message' => 'Ficha creada correctamente.'
        ], 201);
    }

    public function update(FichaRequest $request, $numero)
    {
        $dataFicha = $request->validated();
        $ficha = Ficha::where('numero', '=', $numero)->first();
        if (!$ficha) {
            return response()->json(['error' => 'No se encontró la ficha'], 404);
        }
        $ficha->update($dataFicha);
        return response()->json([
            'message' => 'Ficha actualizada correctamente.'
        ], 200);
    }

    public function destroy($numero)
    {
        $ficha = Ficha::where('numero', '=', $numero)->first();
        if (!$ficha) {
            return response()->json(['error' => 'No se encontró la ficha'], 404);
        }
        $ficha->users()->detach();
        $ficha->delete();
        return response()->json([
           'message' => 'Ficha eliminada correctamente.'
        ], 200);
    }
}
