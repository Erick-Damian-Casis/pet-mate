<form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif

    <div>
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required>
    </div>

    <div>
        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required>
    </div>

    <div>
        <label for="birthdate">Fecha de nacimiento:</label>
        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $user->birthdate ?? '') }}" required>
    </div>

    <div>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }}>
    </div>

    <div>
        <label for="password_confirmation">Confirmar contraseña:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" {{ isset($user) ? '' : 'required' }}>
    </div>

    <button type="submit">{{ isset($user) ? 'Actualizar' : 'Crear' }} usuario</button>
</form>
