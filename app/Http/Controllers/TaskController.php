<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class TaskController extends Controller
{
    /**
     * Guarda una nueva tarea en un área.
     */
    public function store(Request $request, Area $area)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'scheduled_time' => 'required|date_format:H:i',
        ]);

        // Crear la tarea asociada al área
        $task = $area->tasks()->create($validated);

        return redirect()->back();
    }

    /**
     * Marca una tarea como completada/incompleta.
     */
    public function toggle(Task $task)
    {
        $task->update(['completed' => !$task->completed]);
        return redirect()->back();
    }

    /**
     * Agrega comentarios o fotos a una tarea.
     */
    public function addComment(Request $request, Task $task)
    {
        // Validar y guardar datos
        $request->validate([
            'comments' => 'nullable|string',
            'photo' => 'nullable|image|max:2048', // Límite de 2MB
        ]);

        $data = [
            'comments' => $request->input('comments'),
        ];

        // Subir foto si existe
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $data['photo_path'] = Storage::url($path);
        }

        $task->update($data);

        return redirect()->back();
    }

    /**
     * Genera un PDF con las tareas del área.
     */
public function generatePdf(Area $area)
    {
        $tasks = $area->tasks;
        $pdf = Pdf::loadView('pdf.tasks', compact('tasks', 'area'));
        return $pdf->download('reporte-tareas.pdf');
    }
}
