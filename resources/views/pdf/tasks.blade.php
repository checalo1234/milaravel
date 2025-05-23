<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Tareas - {{ $area->name }}</title>
    <style>
        /* Estilos optimizados para PDF */
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { 
            text-align: center; 
            margin-bottom: 25px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .task-item { 
            margin-bottom: 15px;
            page-break-inside: avoid; /* Evita dividir tareas entre páginas */
        }
        .completed { color: #4CAF50; }
        .pending { color: #f44336; }
        .comments { 
            margin-top: 5px;
            font-style: italic;
            color: #666;
        }
        .photo-container {
            margin-top: 10px;
            max-width: 300px;
        }
        .photo {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $area->name }}</h1>
        <p>Reporte generado el: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <h3>Tareas Registradas ({{ $tasks->count() }})</h3>
    
    @foreach($tasks as $task)
        <div class="task-item">
            <h4>
                {{ $task->name }} 
                @if($task->completed)
                    <span class="completed">✓ Completada</span>
                @else
                    <span class="pending">✗ Pendiente</span>
                @endif
            </h4>
            
            <p><strong>Hora programada:</strong> {{ $task->scheduled_time }}</p>
            
            @if($task->comments)
                <div class="comments">
                    <strong>Comentarios:</strong><br>
                    {{ $task->comments }}
                </div>
            @endif

            @if($task->photo_path)
                <div class="photo-container">
                    <strong>Foto:</strong><br>
                    <img 
                        src="{{ storage_path('app/public/' . str_replace('storage/', '', $task->photo_path)) }}" 
                        class="photo" 
                        alt="Foto de la tarea"
                    >
                </div>
            @endif

            <hr>
        </div>
    @endforeach
</body>
</html>