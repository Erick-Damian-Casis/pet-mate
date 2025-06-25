@if ($errors->any())
    <div style="color: red; margin-bottom: 1rem;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($pet) ? route('pets.update', $pet->id) : route('pets.store') }}" method="POST">
    @csrf
    @if(isset($pet))
        @method('PUT')
    @endif

    <div>
        <label for="name">Nombre de la mascota:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $pet->name ?? '') }}" required>
    </div>

    <div>
        <label for="species">Especie:</label>
        <input type="text" id="species" name="species" value="{{ old('species', $pet->species ?? '') }}" required>
    </div>

    <div>
        <label for="race">Raza:</label>
        <input type="text" id="race" name="race" value="{{ old('race', $pet->race ?? '') }}" required>
    </div>

    <div>
        <label for="age">Edad:</label>
        <input type="number" id="age" name="age" value="{{ old('age', $pet->age ?? '') }}" min="0" required>
    </div>

    <div>
        <label for="user_id">Dueño (Usuario):</label>
        <select id="user_id" name="user_id">
            <option value="">-- Sin dueño --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                    {{ old('user_id', $pet->user_id ?? '') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">{{ isset($pet) ? 'Actualizar' : 'Crear' }} mascota</button>
</form>
