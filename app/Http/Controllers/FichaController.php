<?php

namespace App\Http\Controllers;

use App\Http\Requests\FichaRequest;
use App\Models\Ficha;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class FichaController extends Controller
{
    public function index()
    {
        if (AuthServiceProvider::getRole() == AuthServiceProvider::admin) {
            return response()->json(Ficha::all());
        }
        return response()->json(Auth::user()->fichasCreadas);
    }

    public function show($numero)
    {
        $ficha = $this->getFicha($numero);
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
        $ficha->creadoPor()->attach(Auth::id(), ['rol' => 'instructor']);
        return response()->json([
            'message' => 'Ficha creada correctamente.',
            'ficha' => $ficha,
        ], 201);
    }

    public function update(FichaRequest $request, $numero)
    {
        $dataFicha = $request->validated();
        $ficha = $this->getFicha($numero);
        if (!$ficha) {
            return response()->json(['error' => 'No se encontró la ficha'], 404);
        }
        $ficha->update($dataFicha);
        return response()->json([
            'message' => 'Ficha actualizada correctamente.',
            'ficha' => $ficha,
        ], 200);
    }

    public function destroy($numero)
    {
        $ficha = $this->getFicha($numero);
        if (!$ficha) {
            return response()->json(['error' => 'No se encontró la ficha'], 404);
        }
        $ficha->delete();
        return response()->json([
           'message' => 'Ficha eliminada correctamente.'
        ], 200);
    }

    private function getFicha(int $numero) : ? Ficha
    {
        $ficha = Ficha::with('users')->where('numero', '=', $numero);
        if (AuthServiceProvider::getRole() == AuthServiceProvider::admin) {
            $ficha = $ficha->first();
        } else {
            $ficha = $ficha->whereHas('creadoPor', function (Builder $query) {
                $query->where('id', '=', Auth::id());
            })->first();
        }
        return $ficha;
    }
}
