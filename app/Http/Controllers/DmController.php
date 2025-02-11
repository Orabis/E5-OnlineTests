<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Dm;

use Illuminate\Http\Request;

class DmController extends Controller
{
    public function index()
    {
        $dms = Dm::with('professor')->get();
        return view('dms.index', compact('dms'));
    }
    public function create()
    {
        return view('dms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:40',
            'description' => 'string|max:255',
            'expire_at' => 'required|date|after_or_equal:' . now(),
        ], [
            'title.required' => 'Un titre est requis',
            'title.max' => 'Le titre est trop long',
            'description.max' => 'La description est trop longue',
            'expire_at.required' => "Date d'expiration requis",
            'expire_at.after_or_equal' => 'la date ne peut pas être antérieur',
        ]);

        DM::create([
            'professor_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'expire_at' => $request->expire_at,
        ]);
        return redirect()->route('dms.index')->with('success', '');
    }
    public function destroy($id)
    {
        $dm = DM::findOrFail($id);
        $dm->delete();
        return redirect()->route('dms.index')->with('success', '');
    }
}
