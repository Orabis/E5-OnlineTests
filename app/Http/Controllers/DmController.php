<?php

namespace App\Http\Controllers;
use App\Models\Dm;
use App\Models\Questions;
use Illuminate\Http\Request;
use Exception;

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
            'q-file' => 'file|mimes:doc,docx,txt,csv|max:2048',
        ], [
            'title.required' => 'Un titre est requis',
            'title.max' => 'Le titre est trop long',
            'description.max' => 'La description est trop longue',
            'expire_at.required' => "Date d'expiration requis",
            'expire_at.after_or_equal' => 'la date ne peut pas être antérieur',
            'q-file.max' => 'Le fichier est trop lourd',
        ]);
        $dm = DM::create([
            'professor_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'expire_at' => $request->expire_at,
        ]);

        if ($request->hasFile('q-file')) {
            $file = $request->file('q-file');
            $content = file_get_contents($file->getPathname());

            $pattern = '/Q(\d+)\s+\((libre|QCM)\)\s+([^\n]+)((?:\n- .+)*)/mi';
            preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $num = $match[1];
                $type = strtolower($match[2]);
                $question = "Question $num " . trim($match[3]);
                $choicesData = null;

                if ($type === 'qcm') {
                    preg_match_all('/- (.+)/', $match[4], $choices);
                    $choicesData = $choices[1];

                    if (empty($choicesData)) {
                        throw new Exception("Le QCM de la question $num ne contient aucun choix.");
                    }
                }
                if (empty($question)) {
                    throw new Exception("Question vide détectée.");
                }
                $existingQuestion = Questions::where('name', $question)->exists();
                if ($existingQuestion) {
                    throw new Exception("La question $num existe déjà.");
                }
                Questions::create([
                    'name' => $question,
                    'type' => $type === 'qcm' ? 1 : 0,
                    'choices' => json_encode($choicesData),
                    'dm_id' => $dm->id,
                ]);
            }
        } else {
            return redirect()->route('dms.index')->with('warning', 'DM sans question crée');
        }
        return redirect()->route('dms.index')->with('success', 'DM avec question crée');
    }
    public function destroy($id)
    {
        $dm = DM::findOrFail($id);
        $dm->delete();
        return redirect()->route('dms.index')->with('success', 'Dm détruit');
    }
}
