<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data dummy untuk film
        $movies = [
            [
                'id' => 1,
                'title' => 'Sing',
                'release_year' => 2010,
                'thumbnail_url' => 'sing.jpg',
                'category_id' => 5, // Sesuaikan dengan ID kategori
            ],
            [
                'id' => 2,
                'title' => 'The Super Mario Bros Movie',
                'thumbnail_url' => 'mario.webp',
                'release_year' => 2008,
                'category_id' => 5,
            ],
            [
                'id' => 3,
                'title' => 'Kiblat',
                'release_year' => 2014,
                'thumbnail_url' => 'kiblat.webp',
                'category_id' => 6,
            ],
            [
                'id' => 4,
                'title' => 'Red One',
                'release_year' => 1997,
                'thumbnail_url' => 'redone.jpg',
                'category_id' => 4,
            ],
            [
                'id' => 5,
                'title' => 'Dune Part Two',
                'release_year' => 2009,
                'thumbnail_url' => 'dune-part-two.webp',
                'category_id' => 4,
            ],
            [
                'id' => 6,
                'title' => 'Inside Out',
                'release_year' => 2009,
                'thumbnail_url' => 'inside-out.jpg',
                'category_id' => 5,
            ],
            [
                'id' => 7,
                'title' => 'Mechamato Movie',
                'release_year' => 2009,
                'thumbnail_url' => 'mechamato.jpg',
                'category_id' => 4,
            ],
            [
                'id' => 8,
                'title' => 'Us',
                'release_year' => 2009,
                'thumbnail_url' => 'us.jpg',
                'category_id' => 6,
            ],
            [
                'id' => 9,
                'title' => 'Scary Movie',
                'release_year' => 2009,
                'thumbnail_url' => 'scary-movie.jpg',
                'category_id' => 6,
            ],
            [
                'id' => 10,
                'title' => 'Moana 2',
                'release_year' => 2009,
                'thumbnail_url' => 'moana2.jpeg',
                'category_id' => 5,
            ],
            [
                'id' => 11,
                'title' => 'Wicked',
                'release_year' => 2009,
                'thumbnail_url' => 'wicked.jpg',
                'category_id' => 5,
            ],
            [
                'id' => 12,
                'title' => 'Garfield Movie',
                'release_year' => 2009,
                'thumbnail_url' => 'garfield.jpeg',
                'category_id' => 5,
            ],
            [
                'id' => 13,
                'title' => 'Garfield The Movie',
                'release_year' => 2009,
                'thumbnail_url' => 'garfield-movie.png',
                'category_id' => 5,
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }

        // Data dummy untuk detail film
        $movieDetails = [];

        foreach ($movies as $movie) {
            $movieDetails[] = [
                'movie_id' => $movie['id'],
                'description' => "Deskripsi film {$movie['title']}",
                'duration' => rand(60, 180),
                'rating' => rand(1, 10) / 10,
            ];
        }

        foreach ($movieDetails as $detail) {
            Movie::findOrFail($detail['movie_id'])->detail()->create($detail);
        }
    }

    /**
     * Generate thumbnail URL berdasarkan judul film.
     */
    private function generateThumbnailUrl($title)
    {
        // Ubah spasi menjadi "-" dan huruf kecil
        $slug = strtolower(str_replace(' ', '-', $title));

        // Format URL (sesuaikan domain jika perlu)
        return "https://example.com/thumbnails/{$slug}.jpg";
    }
}
