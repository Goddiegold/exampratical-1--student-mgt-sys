<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //

    public function getStudents(Request $request){
        if(session()->has('user-token')){
           $students = Student::all();
           return view('dashboard',['students'=>$students]);
        }else{
            return redirect("/login")->with('message','Please Login First 😒!');
        }
   }

    public function handleEditStudent(Request $request, Student $student){
        if(session()->has('user-token')){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'student_id' => 'required|unique:students,student_id,' . $student->id,
        ]);
    
        $user = DB::table('students')->where('id', $student->id)->first();
    
        if($user){
            if ($user->email != $data['email']) {
                // Validate unique email if it's updated
                $request->validate([
                    'email' => 'unique:users,email',
                ]);
            }
            DB::table('students')
            ->where('id', $student->id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'student_id' => $data['student_id'],
            ]);
            return redirect("/dashboard")->with('message','Updated Record Successfully👍!');
        }else{
            return response()->json(['message' => 'User not registered!'], 404);
        }
    }else{
        return redirect("/login")->with('message','Please Login First 😒!');
    }
    }

    public function handleAddStudent(Request $request){
        if(session()->has('user-token')){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'student_id' => 'required|unique:students,student_id',
            'enrolled_course' => 'required',
        ]);

        $user = DB::table('students')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'student_id'=>$data['student_id'],
            'enrolled_course'=>$data['enrolled_course']
        ]);

        return redirect("/dashboard")->with('message','Added Record Successfully👍!');
    }else{
        return redirect("/login")->with('message','Please Login First 😒!');
    }
    }

    public function editStudent(Request $request, Student $student){
        if(session()->has('user-token')){
    return view('edit_student',['student'=>$student]);
        }else{
            return redirect("/login")->with('message','Please Login First 😒!');
        }
    }

    public function viewStudent(Request $request, Student $student){
        if(session()->has('user-token')){
    return view('view_student',['student'=>$student]);
        }else{
            return redirect("/login")->with('message','Please Login First 😒!');
        }
    }

    public function handleDeleteStudent(Request $request, Student $student){
        if(session()->has('user-token')){
        $student->delete();
        return redirect("/dashboard")->with('message','Deleted Record Successfully👍!');
    }else{
        return redirect("/login")->with('message','Please Login First 😒!');
    }
    }
}
