<?php

namespace App\Http\Controllers;
use App\Http\Resources\PetResource;
use Illuminate\Support\Facades\Http;

use App\Http\Requests\StorePetRequest;
use App\Models\Pet;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with('user')->paginate(10);
        return PetResource::collection($pets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePetRequest $request)
    {
        $data = $request->validated();

        $species = strtolower($data['species']);
        $race = strtolower($data['race']);
        $imageUrl = null;

        if ($species === 'dog') {
            $breeds = Http::withHeaders([
                'x-api-key' => env('DOG_API_KEY'),
            ])->get('https://api.thedogapi.com/v1/breeds')->json();

            $match = collect($breeds)->first(fn($b) => str_contains(strtolower($b['name']), $race));

            if ($match) {
                $imageRes = Http::get('https://api.thedogapi.com/v1/images/search', [
                    'breed_id' => $match['id'],
                ]);
                $imageUrl = $imageRes->json()[0]['url'] ?? null;
            }
        }

        if ($species === 'cat') {
            $breeds = Http::withHeaders([
                'x-api-key' => env('CAT_API_KEY'),
            ])->get('https://api.thecatapi.com/v1/breeds')->json();

            $match = collect($breeds)->first(fn($b) => str_contains(strtolower($b['name']), $race));

            if ($match) {
                $imageRes = Http::get('https://api.thecatapi.com/v1/images/search', [
                    'breed_id' => $match['id'],
                ]);
                $imageUrl = $imageRes->json()[0]['url'] ?? null;
            }
        }

        $data['image_url'] = $imageUrl;

        $pet = Pet::create($data);

        return (new PetResource($pet))
            ->additional(['message' => 'Mascota creada con éxito.'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pet = Pet::with('user')->findOrFail($id);
        return new PetResource($pet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePetRequest $request, string $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update($request->validated());

        return (new PetResource($pet))
            ->additional(['message' => 'Mascota actualizada correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return response()->json(['message' => 'Mascota eliminada correctamente.']);
    }
}
