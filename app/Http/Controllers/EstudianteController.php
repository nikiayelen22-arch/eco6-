<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('foto')){
            $imagen = $request->file('foto')->store('fotos','public');
        } else {
            $imagen = null;
        }
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes',
            'edad' => 'nullable|integer|min:1|max:120',
            'carrera' => 'required|string|max:255',
        ]);

        Estudiante::create($validated + ['foto' => $imagen]);
        return redirect()->route('estudiantes.index')
            ->with('success', '¡Estudiante creado exitosamente!');
    }

    public function show(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email,'.$id,
            'edad' => 'nullable|integer|min:1|max:120',
            'carrera' => 'required|string|max:255',
        ]);

        $estudiante = Estudiante::findOrFail($id);
        $estudiante->update($validated);

        return redirect()->route('estudiantes.index')
            ->with('success', '¡Estudiante actualizado exitosamente!');
    }

    public function destroy(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')
            ->with('success', '¡Estudiante eliminado exitosamente!');
    }
}