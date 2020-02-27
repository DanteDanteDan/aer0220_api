<?php

namespace App\Services;

use App\Models\_payments;
use App\Models\_students;
use App\Models\cat_Cities;
use App\Models\cat_cities_courses;


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

    public function getCountStudents() // Count students
    {

        $result = _students::count();

        return $result;
    }

    public function getStudentsCourses($courses_id) // Count Students in Course
    {

        $result = _students::where('courses_id', $courses_id)
                           ->count();

        return $result;
    }

    public function getAmountCourses($courses_id) // Total Amount in one course
    {

        $result = _students::select('aer0220_payments.amount')
                            ->join('aer0220_payments', 'aer0220_students.student_id', '=', 'aer0220_payments.student_id')
                            ->where('aer0220_students.courses_id', $courses_id)
                            ->get()
                            ->SUM('amount');

        return $result;
    }

    public function getExistStudent($obj) // If Exist / Student
    {

        $student = _students::all()
            ->where('curp', $obj->curp)
            ->first();
        return $student;
    }

    public function getAmount($obj, $courses_id) // Get Amount per course
    {
        $amount = cat_cities_courses::all()
            ->where('city_id', $obj->city_id)
            ->where('courses_id', $courses_id)
            ->first();
        return $amount;
    }

    public function getPercentage($city_id) // Get Percentaje of city
    {
        $percentage = cat_Cities::all()
            ->where('city_id', $city_id)
            ->first();
        return $percentage;
    }

    public function getBirthDate($courses_id) // Get BirthDate
    {
        $result = _students::select('birth_date')
                            ->where('courses_id', $courses_id)
                            ->get();
        return $result;

    }

    public function getLastRegistration($courses_id) // Get Last Registration
    {
        $result = _students::select('updated_at')
                            ->where('courses_id', $courses_id)
                            ->orderBy('updated_at', 'desc')->first();;
        return $result;

    }

    // Post ->
    public function create($obj, $courses_id) // Create Student
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
        $entryStudent->courses_id      = $courses_id;
        $entryStudent->user_type_id    = 2;

        $entryStudent->save();

        return $entryStudent;
    }

    public function renewStudent($obj, $courses_id) // renew student
    {
        $user_type_id = 2;

        _students::where('curp', $obj->curp)->update(
            array(
                'name'            => $obj->name,
                'name_paternal'   => $obj->name_paternal,
                'name_maternal'   => $obj->name_maternal,
                'curp'            => $obj->curp,
                'birth_date'      => $obj->birth_date,
                'allergies'       => $obj->allergies,
                'father_name'     => $obj->father_name,
                'email'           => $obj->email,
                'whatsapp'        => $obj->whatsapp,
                'home_phone'      => $obj->home_phone,
                'origin_school'   => $obj->origin_school,
                'grade_id'        => $obj->grade_id,
                'meet_us_id'      => $obj->meet_us_id,
                'relationship_id' => $obj->relationship_id,
                'gender_id'       => $obj->gender_id,
                'city_id'         => $obj->city_id,
                'courses_id'      => $courses_id,
                'user_type_id'    => $user_type_id
            )
        );
    }

    public function createPayment($obj, $id, $amount) // Create Payment
    {
        $entryPayment = new _payments;

        $payment_status_id = 2;

        // Payment
        $entryPayment->student_id        = $id;
        $entryPayment->payment_types_id  = $obj->payment_types_id;
        $entryPayment->amount            = $amount;
        $entryPayment->payment_status_id = $payment_status_id;

        $entryPayment->save();

        return $entryPayment;
    }
}
