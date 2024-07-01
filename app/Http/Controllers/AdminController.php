<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
Use App\Models\Exam;

class AdminController extends Controller
{
    // subject add
    public function addSubject(Request $request){
        try {
            
            $request->validate([
                'subject' => 'required|unique:subjects,subject'
            ]);
            
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
    //subject edit
    public function editSubject(Request $request){
        try {
            
            $request->validate([
                'subject' => 'required|unique:subjects,subject'
            ]);

            // update the subject into the database
            $subject = Subject::find($request->id);
            $subject->subject = $request->subject;
            $subject->save();

    
            // Return success response
            return response()->json(['success' => true, 'msg' => 'Subject updated successfully.']);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    //subject delete
    public function deleteSubject(Request $request){
        try {
            
            // delete the subject into the database
            $subject = Subject::where('id',$request->id)->delete();
            
            // Return success response
            return response()->json(['success' => true, 'msg' => 'Subject deleted successfully.']);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // exam dashboard load
    public function examDashboard(){
        $subjects = Subject::all();
        $exams = Exam::with('subjects')->get();
        return view('admin.exam-dashboard',['subjects' => $subjects , 'exams' => $exams]);
    }
    public function addExam(Request $request){

        try {
            
            // insert the exam into the database
            Exam::create([
                'exam_name' => $request->exam_name,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'time' => $request->time
            ]);
            
            // Return success response
            return response()->json(['success' => true, 'msg' => 'Exam Added successfully.']);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}

