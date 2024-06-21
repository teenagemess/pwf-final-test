<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class DetailArtikelController extends Controller
{
    public function show($id)
    {
        $todo = Todo::findOrFail($id);

        return view('detail_artikel', [
            'todo' => $todo
        ]);
    }
}
