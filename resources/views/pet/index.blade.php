@foreach ($pets as $pet)
    <p>{{ $pet->name }}</p>
@endforeach

{{ $pets->links() }}
