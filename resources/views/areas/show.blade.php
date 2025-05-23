<!DOCTYPE html>
<html>
<head>
    <title>{{ $area->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>{{ $area->name }} - {{ $progress }}%</h1>
    <a href="{{ route('tasks.pdf', $area) }}">Descargar PDF</a>

    <form action="{{ route('tasks.store', ['area' => $area->id]) }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Tarea" required>
    <input type="time" name="scheduled_time" required>
    <button>Agregar Tarea</button>
</form>

    @foreach ($area->tasks as $task)
    <div class="task flex items-center gap-4 py-2">
        <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="m-0">
            @csrf
            @method('PUT') <!-- Simula un método PUT -->
            <input 
                type="checkbox" 
                onchange="this.form.submit()" 
                {{ $task->completed ? 'checked' : '' }}
                class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            >
        </form>
        <span class="flex-1">{{ $task->name }} - {{ $task->scheduled_time }}</span>
        <button 
            onclick="showCommentForm({{ $task->id }})" 
            class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
        >
            ▲
        </button>
    </div>
@endforeach

    <div id="commentForm" style="display:none">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea name="comments"></textarea>
            <input type="file" name="photo">
            <button>Guardar</button>
        </form>
    </div>

    <script>
        function showCommentForm(taskId) {
            const form = document.getElementById('commentForm');
            form.style.display = 'block';
            form.querySelector('form').action = `/tasks/${taskId}/comment`;
        }
    </script>
</body>
</html>