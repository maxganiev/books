<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Author;


class AuthorController extends Controller
{
    public function index(Request $request)
    {


        return response()->json(Author::all());
    }
}
