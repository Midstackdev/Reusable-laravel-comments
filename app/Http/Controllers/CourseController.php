<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(Course $course)
    {
    	dd($course->comments->first()->children);
    	return view('courses.show', compact('course'));
    }
}
