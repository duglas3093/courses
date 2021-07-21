<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedCourse;
use App\Mail\RejectCourse;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::where('status', 2)->paginate();
        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course){

        //coursePolice
        $this->authorize('revision', $course);

        return view('admin.courses.show', compact('course'));
    }

    public function approved(Course $course){
        $this->authorize('revision', $course);

        if (!$course->lessons || !$course->goals || !$course->requirements || !$course->image) {
            return back()->with('info', 'No se puede piblicar un curso que no este completo');
        }

        $course->status = 3;
        $course->save();

        // Enviar el correo electronico
        $mail = new ApprovedCourse($course);

        // con el metodo de sync en el .env  QUEUE_CONNECTION=sync
        // Mail::to($course->teacher->email)->send($mail);

        // con el metodo de database en el .env QUEUE_CONNECTION=database
        Mail::to($course->teacher->email)->queue($mail);

        return redirect()->route('admin.courses.index')->with('info','El curos se publicó con exitó');
    }

    public function observation(Course $course){
        return view('admin.courses.observation', compact('course'));
    }

    public function reject(Request $request, Course $course){
        $request->validate([
            'body' => 'required',
        ]);
        // return $request->all();
        $course->observation()->create($request->all());
        $course->status = 1;
        $course->save();
        $mail = new RejectCourse($course);

        Mail::to($course->teacher->email)->queue($mail);
        return redirect()->route('admin.courses.index')->with('info','El curos se ha rechazado con exitó');

    }
}
