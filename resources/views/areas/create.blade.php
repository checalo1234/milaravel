<!DOCTYPE html>
<html>
<head>
    <title>Crear Área</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Crear Nueva Área</h1>
    <form action="{{ route('areas.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nombre del Área" required>
        <textarea name="description" placeholder="Descripción"></textarea>
        <button type="submit">Crear</button>
    </form>
</body>
</html>