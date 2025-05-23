<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Muestra la lista de áreas.
     */
    public function index()
    {
        $areas = Area::all(); // Obtener todas las áreas
        return view('areas.index', compact('areas'));
    }

    /**
     * Muestra el formulario para crear un área.
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Guarda un área nueva en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Crear el área
        $area = Area::create($validated);

        // Redirigir a la vista del área creada
        return redirect()->route('areas.show', $area);
    }

    /**
     * Muestra los detalles de un área específica.
     */
    public function show(Area $area)
    {
        // Calcular el progreso (ej: promedio de tareas completadas)
        $progress = $area->tasks()->avg('completed') * 100;

        return view('areas.show', compact('area', 'progress'));
    }
}