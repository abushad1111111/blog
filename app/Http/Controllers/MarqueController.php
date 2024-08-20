<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function marqueList()
    {
        $marques = Marque::all();
        return view('backend.marque.list', compact('marques'));
    }

    public function marqueForm()
    {
        return view('backend.marque.create');
    }

    public function marqueCreate(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $marque = $request->only(['title']);
        Marque::create($marque);
        return redirect()->route('marque.list')->with('success', 'Marque created successfully.');
    }

    public function marqueDestroy($id)
    {
        $marque = Marque::findOrFail($id);
        $marque->delete();
        return redirect()->route('marque.list')->with('success', 'Marque deleted successfully.');
    }
}
