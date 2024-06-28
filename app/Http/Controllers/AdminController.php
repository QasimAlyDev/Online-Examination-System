<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class AdminController extends Controller
{
    public function addSubject(Request $request){
        try {
    
            // Insert the subject into the database
            Subject::create([
                'subject' => $request->subject
            ]);
    
            // Return success response
            return response()->json(['success' => true, 'msg' => 'Subject added successfully.']);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    
}

