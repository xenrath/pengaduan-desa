<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;

class PersonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $people = Person::orderBy('name', 'ASC')->get();

        return view('pages.person.index', compact('people'));
    }

    public function create(){
        return view('pages.person.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'NIK' => 'required|unique:people', 
            'name' => 'required'
        ]);

        Person::create($request->all());

        return redirect()->route('person.index')->with('success', 'Create new data is successful');
    }

    public function edit($id){
        $person = Person::findOrFail($id);

        return view('pages.person.edit', compact('person'));
    }

    public function update(Request $request, $id){
        $person = Person::findOrFail($id);

        $person->update([
            'NIK' => $request->NIK,
            'name' => $request->name,
        ]);

        return redirect()->route('person.index')->with('success', 'Update data is successful');
    }

    public function destroy($id){
        $person = Person::findOrFail($id);

        $person->delete();

        return redirect()->route('person.index')->with('success', 'Delete data is successful');
    }
}
