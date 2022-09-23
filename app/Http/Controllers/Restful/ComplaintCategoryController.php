<?php

namespace App\Http\Controllers\Restful;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;

class ComplaintCategoryController extends Controller
{
    public function index() {
        $complaintCategories = ComplaintCategory::orderBy('complaint_category_name')->get();

        return response()->json([
            "message" => "Success Get Complaint Category",
            "status" => 200,
            "data" => $complaintCategories
        ]);
    }

    public function store(Request $request) {
        $complaintCategories = ComplaintCategory::create([
            'complaint_category_name' => $request->complaint_category_name
        ]);

        return response()->json([
            "message" => "Create a new complaint category is successful",
            "status" => 200,
            "data" => $complaintCategories
        ]);
    }

    public function update(Request $request, $id){
        $complaintCategories = ComplaintCategory::findOrFail($id);
        $complaintCategories->update([
            'complaint_category_name' => $request->complaint_category_name
        ]);

        return response()->json([
            "message" => "Update complaint category is successful",
            "status" => 200,
            "data" => $complaintCategories
        ]);
    }

    public function destroy($id){
        $complaintCategories = ComplaintCategory::findOrFail($id);
        $complaintCategories->delete();

        return response()->json([
            "message" => "Delete complaint category is successful",
            "status" => 200,
            "data" => $complaintCategories
        ]);
    }
}
