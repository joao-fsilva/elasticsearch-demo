<?php

namespace App\Http\Controllers;

use Demo\Domain\Entity\Movie;
use Demo\Domain\Repository\MovieRepository;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request, MovieRepository $movieRepository)
    {
        $movieRepository->update(new Movie('title', 'genre'));
        $movieRepository->getByParams([]);

        return response()->json();
    }
}
