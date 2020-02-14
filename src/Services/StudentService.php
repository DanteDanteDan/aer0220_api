<?php

namespace App\Services;

use App\Models\aer0220_cat_courses;
use PDO;

class StudentService {

     public function getCourses() {
         return aer0220_cat_courses::all();
     }

     public function getCourse(int $courses_id) {
        //return aer0220_cat_courses::find($courses_id);
        $db = new DataBase();
        $db = $db->conectDB();
        $sql = "SELECT level FROM aer0220_cat_courses where courses_id = $courses_id ";
        $content = $db->query($sql);
        $result = $content->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
 }