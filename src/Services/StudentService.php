<?php

namespace App\Services;

use App\Models\_payments;
use App\Models\_students;

class StudentService
{

    // Get ->
    public function getStudents() // All students
    {

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

    public function getStudent(int $student_id) // One student
    {

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

    // Post ->
    public function create($obj) // Create Student
    {

        $entryStudent = new _students;

        // Student
        $entryStudent->name            = $obj->name;
        $entryStudent->name_paternal   = $obj->name_paternal;
        $entryStudent->name_maternal   = $obj->name_maternal;
        $entryStudent->curp            = $obj->curp;
        $entryStudent->birth_date      = $obj->birth_date;
        $entryStudent->allergies       = $obj->allergies;
        $entryStudent->father_name     = $obj->father_name;
        $entryStudent->email           = $obj->email;
        $entryStudent->whatsapp        = $obj->whatsapp;
        $entryStudent->home_phone      = $obj->home_phone;
        $entryStudent->origin_school   = $obj->origin_school;
        $entryStudent->grade_id        = $obj->grade_id;
        $entryStudent->meet_us_id      = $obj->meet_us_id;
        $entryStudent->relationship_id = $obj->relationship_id;
        $entryStudent->gender_id       = $obj->gender_id;
        $entryStudent->city_id         = $obj->city_id;
        $entryStudent->courses_id      = $obj->courses_id;
        $entryStudent->user_type_id    = $obj->user_type_id;

        $entryStudent->save();

        return $entryStudent;
    }


    public function createPayment($obj, $id) // Create Payment
    {
        $entryPayment = new _payments;

        // Payment
        $entryPayment->student_id        = $id;
        $entryPayment->payment_types_id  = $obj->payment_types_id;
        $entryPayment->amount            = $obj->amount;
        $entryPayment->payment_status_id = $obj->payment_status_id;

        $entryPayment->save();

        return $entryPayment;
    }
}
