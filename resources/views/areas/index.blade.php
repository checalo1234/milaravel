<!DOCTYPE html>
<html>
<head>
    <title>Áreas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Gestiona tus áreas de trabajo</h1>
    @foreach ($areas as $area)
        <div class="area-card">
            <a href="{{ route('areas.show', $area) }}">{{ $area->name }}</a>
            <div class="progress-bar">
                <div style="width: {{ $area->progress }}%"></div>
            </div>
        </div>
    @endforeach
    <a href="{{ route('areas.create') }}">Crear Nueva Área</a>
</body>
</html>