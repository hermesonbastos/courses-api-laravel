<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return response()->json($courses, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'hours'       => 'required|integer',
        ]);

        $course = Course::create([
            'title'       => $request->title,
            'description' => $request->description,
            'hours'       => $request->hours,
        ]);

        return response()->json($course, 201);
    }

    public function show($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Curso não encontrado'], 404);
        }

        return response()->json($course, 200);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Curso não encontrado'], 404);
        }

        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hours'       => 'nullable|integer',
        ]);

        $course->update($request->all());

        return response()->json($course, 200);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Curso não encontrado'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Curso removido com sucesso'], 200);
    }
}

