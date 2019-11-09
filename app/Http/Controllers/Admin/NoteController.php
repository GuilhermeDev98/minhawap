<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
use App\Comunity;
use Auth;

class NoteController extends Controller
{
    public function index(){
        $notes = Note::paginate(20);
        return view('admin.note.index')->with('notes', $notes);
    }

    public function create(){
        $comunities = Comunity::all();
        return view('admin.note.create')->with('comunities', $comunities);
    }

    public function store(Request $request){
        $request['user_id'] = Auth::user()->id;
        $note = Note::create($request->except('_token'));
        
        if($note){
            return redirect()->route('admin.note.index');
        }

        return redirect()->route('admin.note.create')->with('error', 'Erro ao cadastrar Nota');
    }

    public function edit(Note $note){
        $comunities = Comunity::all();
        return view('admin.note.edit')->with([
            'note' => $note,
            'comunities' => $comunities
        ]);
    }

    public function update(Note $note, Request $request){
        try {
            $note->update($request->except('_token'));
            return redirect()->route('admin.note.index');            
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy(Note $note){
        try {
            $note->delete();
            return redirect()->route('admin.note.index');            
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
