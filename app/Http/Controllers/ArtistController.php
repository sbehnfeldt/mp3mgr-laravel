<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;


class ArtistController extends Controller
{

    // Fetch all Artist records (paginated)
    public function index()
    {
        return Artist::withCount('albums')->paginate(25);
    }


    // Fetch a single Artist record, with corresponding albums and tracks
    public function show($id)
    {
        $artist = Artist::with([
            'albums' => function ($query) {
                $query->with('tracks');
            }
        ])->findOrFail($id);
        return $artist;
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
