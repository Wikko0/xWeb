<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Units;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RankingController extends Controller
{
    public function index(Request $request): View
    {

        $selectedCharacters = Character::getTopCharacters(15);

        $search = $request->input('search');
        $searchBy = $request->input('searchBy');

        if (isset($search)) {
            $selectedCharacters = Character::searchByName($search, 15);
        }
        if (isset($searchBy)) {
            $selectedCharacters = Character::searchByClass($searchBy, 15);
        }

        $output = '';
        foreach ($selectedCharacters as $index => $row) {
            $row = Units::generateCharacterRow($index, $row);
            $output .= $row;
        }

        return view('ranking', [
            'output' => $output,
            'selectedCharacters' => $selectedCharacters
        ]);
    }
}
