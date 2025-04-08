<?php

namespace App\Http\Controllers;

use App\Models\Promocional;
use App\Models\PromocionalFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromocionalController extends Controller
{
    public function index()
    {
        $promocionales = Promocional::with('fotos')->get();
        return view('promocionales_list', compact('promocionales'));
    }

    public function create()
    {
        return view('promocional_form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria' => 'required|in:Agendas Zegno,Antiestres,Artículos de Viaje,Bar,Bebidas,Belleza,Bolsas,Complementos,Deportes,Entretenimiento,Escritura,Herramientas,Hieleras Loncheras y Portaviandas,Hogar,Libretas y Carpetas,Llaveros,Maletas,Mochilas,Niños,Oficina,Paraguas e Impermeables,Portafolios,Salud,Tecnología,Textiles',
            'tipo' => 'required|string|max:255',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $promocional = Promocional::create($validatedData);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('uploads', 'public');
                $promocional->fotos()->create(['foto_path' => $path]);
            }
        }

        return redirect()->route('promocionales.index')->with('success', 'Promocional creado exitosamente');
    }

    public function edit($id)
    {
        $promocional = Promocional::with('fotos')->findOrFail($id);
        return view('promocional_form', compact('promocional'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'categoria' => 'sometimes|in:Agendas Zegno,Antiestres,Artículos de Viaje,Bar,Bebidas,Belleza,Bolsas,Complementos,Deportes,Entretenimiento,Escritura,Herramientas,Hieleras Loncheras y Portaviandas,Hogar,Libretas y Carpetas,Llaveros,Maletas,Mochilas,Niños,Oficina,Paraguas e Impermeables,Portafolios,Salud,Tecnología,Textiles',
            'tipo' => 'sometimes|string|max:255',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $promocional = Promocional::findOrFail($id);
        $promocional->update($request->only(['nombre', 'descripcion', 'categoria', 'tipo']));

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('uploads', 'public');
                $promocional->fotos()->create(['foto_path' => $path]);
            }
        }

        return redirect()->route('promocionales.index')->with('success', 'Promocional actualizado exitosamente');
    }

    public function destroy($id)
    {
        $promocional = Promocional::findOrFail($id);
        foreach ($promocional->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto_path);
            $foto->delete();
        }
        $promocional->delete();

        return redirect()->route('promocionales.index')->with('success', 'Promocional eliminado exitosamente');
    }

    public function destroyPhoto($fotoId)
    {
        $foto = PromocionalFoto::findOrFail($fotoId);
        Storage::disk('public')->delete($foto->foto_path);
        $foto->delete();

        return redirect()->back()->with('success', 'Foto eliminada exitosamente');
    }

    // Métodos para API
    public function apiIndex()
    {
        $promocionales = Promocional::with('fotos')->get();
        return response()->json($promocionales);
    }

    public function apiShow($id)
    {
        $promocional = Promocional::with('fotos')->findOrFail($id);
        return response()->json($promocional);
    }
}
