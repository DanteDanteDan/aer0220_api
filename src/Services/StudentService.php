<?php

namespace App\Services;

use App\Models\_students;

class StudentService {

    // Get ->
    public function getStudents() { // All students

        $result = _students::all();

        foreach ($result as $item) { // FK
            $item->studentGrade;
            $item->studentMeetUs;
            $item->studentRelationship;
            $item->studentCity;
            $item->studentCourses;
            $item->studentUserType;
        }

        return $result;
    }

    public function getStudent(int $student_id) { // One student

        $student = _students::where('student_id', $student_id)
                            ->first();
        // FK user_type_id
        $student->studentGrade;
        $student->studentMeetUs;
        $student->studentRelationship;
        $student->studentCity;
        $student->studentCourses;
        $student->studentUserType;

        return $student;
    }

    // Post -> /Students


 }