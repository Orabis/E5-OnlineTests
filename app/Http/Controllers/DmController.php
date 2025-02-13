<?php

namespace App\Http\Controllers;
use App\Models\Dm;
use App\Models\Questions;
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
            //DM//
            'q-name' => 'required|string|max:255',
            'q-type' => 'required|boolean',
            'q-choices' => 'nullable|string',
        ], [
            'title.required' => 'Un titre est requis',
            'title.max' => 'Le titre est trop long',
            'description.max' => 'La description est trop longue',
            'expire_at.required' => "Date d'expiration requis",
            'expire_at.after_or_equal' => 'la date ne peut pas être antérieur',
            'q-name.required' => 'Un nom de questions est requis',
            'q-name.max' => 'Le nom est trop long',
        ]);

        $dm = DM::create([
            'professor_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'expire_at' => $request->expire_at,
        ]);

        $choicesData = null;

        if ($request->get('q-type') && $request->get('q-choices')) {
            $choicesData = explode(',', $request->get('q-choices'));

            if (count($choicesData) <= 2) {
                return redirect()->route('dms.index')->with('warning', 'DM sans question crée, choix insufissant pour crée un qcm');
            }
            $choicesData = json_encode(value: $choicesData);
        }
        Questions::create([
            'name' => $request->get('q-name'),
            'type' => $request->get('q-type'),
            'choices' => $choicesData,
            'dm_id' => $dm->id,
        ]);

        return redirect()->route('dms.index')->with('success', 'DM avec Questions crée');
    }
    public function destroy($id)
    {
        $dm = DM::findOrFail($id);
        $dm->delete();
        return redirect()->route('dms.index')->with('success', 'Dm détruit');
    }
}
