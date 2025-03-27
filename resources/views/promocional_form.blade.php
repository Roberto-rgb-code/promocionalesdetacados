<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($promocional) ? 'Editar Promocional' : 'Agregar Promocional' }}</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        textarea { height: 100px; }
        button { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #218838; }
        .btn-secondary { background-color: #6c757d; margin-left: 10px; }
        .btn-secondary:hover { background-color: #5a6268; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 0.9em; text-align: center; }
        .photo-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .photo { position: relative; }
        .photo img { width: 100px; height: 100px; object-fit: cover; border-radius: 4px; }
        .photo button { position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; }
        .photo-inputs { margin-top: 10px; }
        .photo-inputs input { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ isset($promocional) ? 'Editar Promocional' : 'Agregar Promocional' }}</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($promocional) ? route('promocionales.update', $promocional->id) : route('promocionales.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($promocional))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $promocional->nombre ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" required>{{ old('descripcion', $promocional->descripcion ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select name="categoria" id="categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <option value="Agendas Zegno" {{ old('categoria', $promocional->categoria ?? '') == 'Agendas Zegno' ? 'selected' : '' }}>Agendas Zegno</option>
                    <option value="Antiestres" {{ old('categoria', $promocional->categoria ?? '') == 'Antiestres' ? 'selected' : '' }}>Antiestres</option>
                    <option value="Artículos de Viaje" {{ old('categoria', $promocional->categoria ?? '') == 'Artículos de Viaje' ? 'selected' : '' }}>Artículos de Viaje</option>
                    <option value="Bar" {{ old('categoria', $promocional->categoria ?? '') == 'Bar' ? 'selected' : '' }}>Bar</option>
                    <option value="Bebidas" {{ old('categoria', $promocional->categoria ?? '') == 'Bebidas' ? 'selected' : '' }}>Bebidas</option>
                    <option value="Belleza" {{ old('categoria', $promocional->categoria ?? '') == 'Belleza' ? 'selected' : '' }}>Belleza</option>
                    <option value="Bolsas" {{ old('categoria', $promocional->categoria ?? '') == 'Bolsas' ? 'selected' : '' }}>Bolsas</option>
                    <option value="Complementos" {{ old('categoria', $promocional->categoria ?? '') == 'Complementos' ? 'selected' : '' }}>Complementos</option>
                    <option value="Deportes" {{ old('categoria', $promocional->categoria ?? '') == 'Deportes' ? 'selected' : '' }}>Deportes</option>
                    <option value="Entretenimiento" {{ old('categoria', $promocional->categoria ?? '') == 'Entretenimiento' ? 'selected' : '' }}>Entretenimiento</option>
                    <option value="Escritura" {{ old('categoria', $promocional->categoria ?? '') == 'Escritura' ? 'selected' : '' }}>Escritura</option>
                    <option value="Herramientas" {{ old('categoria', $promocional->categoria ?? '') == 'Herramientas' ? 'selected' : '' }}>Herramientas</option>
                    <option value="Hieleras Loncheras y Portaviandas" {{ old('categoria', $promocional->categoria ?? '') == 'Hieleras Loncheras y Portaviandas' ? 'selected' : '' }}>Hieleras Loncheras y Portaviandas</option>
                    <option value="Hogar" {{ old('categoria', $promocional->categoria ?? '') == 'Hogar' ? 'selected' : '' }}>Hogar</option>
                    <option value="Libretas y Carpetas" {{ old('categoria', $promocional->categoria ?? '') == 'Libretas y Carpetas' ? 'selected' : '' }}>Libretas y Carpetas</option>
                    <option value="Llaveros" {{ old('categoria', $promocional->categoria ?? '') == 'Llaveros' ? 'selected' : '' }}>Llaveros</option>
                    <option value="Maletas" {{ old('categoria', $promocional->categoria ?? '') == 'Maletas' ? 'selected' : '' }}>Maletas</option>
                    <option value="Mochilas" {{ old('categoria', $promocional->categoria ?? '') == 'Mochilas' ? 'selected' : '' }}>Mochilas</option>
                    <option value="Niños" {{ old('categoria', $promocional->categoria ?? '') == 'Niños' ? 'selected' : '' }}>Niños</option>
                    <option value="Oficina" {{ old('categoria', $promocional->categoria ?? '') == 'Oficina' ? 'selected' : '' }}>Oficina</option>
                    <option value="Paraguas e Impermeables" {{ old('categoria', $promocional->categoria ?? '') == 'Paraguas e Impermeables' ? 'selected' : '' }}>Paraguas e Impermeables</option>
                    <option value="Portafolios" {{ old('categoria', $promocional->categoria ?? '') == 'Portafolios' ? 'selected' : '' }}>Portafolios</option>
                    <option value="Salud" {{ old('categoria', $promocional->categoria ?? '') == 'Salud' ? 'selected' : '' }}>Salud</option>
                    <option value="Tecnología" {{ old('categoria', $promocional->categoria ?? '') == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
                    <option value="Textiles" {{ old('categoria', $promocional->categoria ?? '') == 'Textiles' ? 'selected' : '' }}>Textiles</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" id="tipo" value="{{ old('tipo', $promocional->tipo ?? '') }}" required>
            </div>

            @if (isset($promocional) && $promocional->fotos->isNotEmpty())
                <div class="form-group">
                    <label>Fotos Existentes</label>
                    <div class="photo-grid">
                        @foreach ($promocional->fotos as $foto)
                            <div class="photo">
                                <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto">
                                <form action="{{ route('promocional-fotos.destroy', $foto->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar esta foto?')">X</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label>Fotos (puedes seleccionar varias)</label>
                <div id="photo-inputs" class="photo-inputs">
                    <input type="file" name="fotos[]" class="form-input" multiple accept="image/*">
                </div>
                <button type="button" class="btn btn-primary" onclick="addPhotoInput()" style="margin-top: 10px;">Agregar Más Fotos</button>
            </div>

            <button type="submit">{{ isset($promocional) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('promocionales.index') }}" class="btn-secondary">Ver Lista</a>
        </form>
    </div>

    <script>
        function addPhotoInput() {
            const photoInputs = document.getElementById('photo-inputs');
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'fotos[]';
            newInput.className = 'form-input';
            newInput.multiple = true;
            newInput.accept = 'image/*';
            newInput.style.marginTop = '10px';
            photoInputs.appendChild(newInput);
        }
    </script>
</body>
</html>