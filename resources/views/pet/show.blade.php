<h2>{{ $pet->name }}</h2>
<p>Especie: {{ $pet->species }}</p>
<p>Raza: {{ $pet->race }}</p>
<p>Edad: {{ $pet->age }}</p>
<p>Dueño: {{ $pet->user->name ?? 'Sin dueño' }}</p>
