<?php

namespace App\Services;

use App\Models\cat_courses;
use PDO;

class StudentService {

    public function getCities() {
        return cat_courses::all();
    }

    public function getCourses() {
        return cat_courses::all();
    }

    public function getCourse(int $courses_id) {
        //return cat_courses::find($courses_id);
        $user = cat_courses::where('courses_id', $courses_id)
                             ->first();
        /*return $user;
        $db = new DataBase();
        $db = $db->conectDB();
        $sql = "SELECT level FROM aer0220_cat_courses where courses_id = $courses_id ";
        $content = $db->query($sql);
        $result = $content->fetchAll(PDO::FETCH_OBJ);
        return $result;*/
    }

    public function getGenders() {
        return cat_courses::all();
    }

    public function getGrade() {
        return cat_courses::all();
    }

    public function getMeetUs() {
        return cat_courses::all();
    }

    public function getPaymentStatus() {
        return cat_courses::all();
    }

    public function getPaymentType() {
        return cat_courses::all();
    }

    public function getRelationship() {
        return cat_courses::all();
    }

    public function getUserTypes() {
        return cat_courses::all();
    }

    public function getPayments() {
        return cat_courses::all();
    }

    public function getStudents() {
        return cat_courses::all();
    }


 }