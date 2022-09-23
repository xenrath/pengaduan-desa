<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComplaintCategory;

class AdminCategoryComplaintController extends Controller
{
    public function index(){
        $complaint_categories = ComplaintCategory::orderBy('complaint_category_name')->get();

        return view('pages.complaint_category.index', compact('complaint_categories'));
    }

    public function store(Request $request){
        $rules = [
            'complaint_category_name' => 'required'
        ];

        $message = [
            'required' => 'Form :attribute tidak boleh kosong!'
        ];

        $this->validate($request, $rules, $message);

        if($request->id_category === null){
            ComplaintCategory::create([
                'complaint_category_name' => $request->complaint_category_name
            ]);
        }else{
            $complaint_category = ComplaintCategory::findOrFail($request->id_category);
            $complaint_category->update([
                'complaint_category_name' => $request->complaint_category_name
            ]);
        }

        return redirect()->back();
    }

    public function destroy($id){
        $complaint_category = ComplaintCategory::findOrFail($id);
        $complaint_category->delete();

        return redirect()->back();

    }
}
