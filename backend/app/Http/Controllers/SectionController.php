<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    private $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function index()
    {
        $all_sections = $this->section->latest()->get();

        return view('sections.index')
            ->with('all_sections', $all_sections);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50',
        ]);

        $this->section->name = $request->name;
        $this->section->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->section->destroy($id);

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $sections = $this->section->where('name', 'like', '%'.$request->search.'%')->get();

        return view('sections.search')->with('sections', $sections)->with('search', $request->search);
    }
}


