<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class WelcomeController extends Controller
{
    public function index()
    {
        // Mengambil maksimal 12 data per halaman dengan pagination
        $todos = Todo::paginate(9);

        return view('welcome', compact('todos'));
    }
}
