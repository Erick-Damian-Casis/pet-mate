<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = ['dog', 'cat', 'rabbit', 'bird'];
        $races = [
            'dog' => ['Labrador', 'Pug', 'Bulldog'],
            'cat' => ['Siamese', 'Persian', 'Maine Coon'],
            'rabbit' => ['Mini Rex', 'Dutch', 'Lionhead'],
            'bird' => ['Parakeet', 'Canary', 'Parrot'],
        ];

        $speciesChosen = $this->faker->randomElement($species);
        $raceChosen = $this->faker->randomElement($races[$speciesChosen]);
        $imageUrl = null;

        if ($speciesChosen === 'dog') {
            $breeds = Http::withHeaders([
                'x-api-key' => env('DOG_API_KEY'),
            ])->get('https://api.thedogapi.com/v1/breeds')->json();

            $breed = collect($breeds)->first(fn($b) => str_contains(strtolower($b['name']), strtolower($raceChosen)));

            if ($breed) {
                $img = Http::get('https://api.thedogapi.com/v1/images/search', [
                    'breed_id' => $breed['id']
                ])->json();
                $imageUrl = $img[0]['url'] ?? null;
            }
        }

        if ($speciesChosen === 'cat') {
            $breeds = Http::withHeaders([
                'x-api-key' => env('CAT_API_KEY'),
            ])->get('https://api.thecatapi.com/v1/breeds')->json();

            $breed = collect($breeds)->first(fn($b) => str_contains(strtolower($b['name']), strtolower($raceChosen)));

            if ($breed) {
                $img = Http::get('https://api.thecatapi.com/v1/images/search', [
                    'breed_id' => $breed['id']
                ])->json();
                $imageUrl = $img[0]['url'] ?? null;
            }
        }

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->firstName,
            'species' => $speciesChosen,
            'race' => $raceChosen,
            'age' => $this->faker->numberBetween(0, 20),
            'image_url' => $imageUrl,
        ];
    }

}
