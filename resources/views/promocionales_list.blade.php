<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Promocionales</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .success { color: green; text-align: center; margin-bottom: 15px; }
        .promocional { border-bottom: 1px solid #ddd; padding: 10px 0; }
        .promocional img { width: 50px; height: 50px; object-fit: cover; margin-right: 10px; }
        .actions { margin-top: 10px; }
        .btn { padding: 5px 10px; border-radius: 4px; text-decoration: none; color: white; }
        .btn-edit { background-color: #007bff; }
        .btn-delete { background-color: #dc3545; }
        .btn-add { background-color: #28a745; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Promocionales</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('promocionales.create') }}" class="btn btn-add">Agregar Nuevo Promocional</a>

        @if ($promocionales->isEmpty())
            <p>No hay promocionales registrados.</p>
        @else
            @foreach ($promocionales as $promocional)
                <div class="promocional">
                    <h3>{{ $promocional->nombre }}</h3>
                    <p>{{ $promocional->descripcion }}</p>
                    <p>Categoría: {{ $promocional->categoria }} | Tipo: {{ $promocional->tipo }}</p>
                    @if ($promocional->fotos->isNotEmpty())
                        @foreach ($promocional->fotos as $foto)
                            <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="{{ $promocional->nombre }}">
                        @endforeach
                    @endif
                    <div class="actions">
                        <a href="{{ route('promocionales.edit', $promocional->id) }}" class="btn btn-edit">Editar</a>
                        <form action="{{ route('promocionales.destroy', $promocional->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este promocional?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>