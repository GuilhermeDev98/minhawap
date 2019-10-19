<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
use App\Comunity;

class NoteController extends Controller
{
    public function index(Request $request){
        $messages = [];
            $comunities = Comunity::where('active', true)->with(['notes'])->get();
            foreach ($comunities as $comunity) {
                foreach ($comunity->notes as $note) {
                    array_push($messages, $note->text);
                }
            }
    
        return response()->json($messages);
    }
}
