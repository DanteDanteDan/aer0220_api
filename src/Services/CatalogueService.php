<?php

namespace App\Services;
use App\Models\cat_cities;
use App\Models\cat_courses;
use App\Models\cat_genders;
use App\Models\cat_grade;
use App\Models\cat_meet_us;
use App\Models\cat_payment_status;
use App\Models\cat_payment_types;
use App\Models\cat_relationship;
use App\Models\cat_user_types;

class CatalogueService {

    // Get -> Catalogue
    public function getCities() {
        return cat_cities::all();
    }

    public function getCourses() {
        return cat_courses::all();
    }

    public function getGenders() {
        return cat_genders::all();
    }

    public function getGrade() {
        return cat_grade::all();
    }

    public function getMeetUs() {
        return cat_meet_us::all();
    }

    public function getPaymentStatus() {
        return cat_payment_status::all();
    }

    public function getPaymentType() {
        return cat_payment_types::all();
    }

    public function getRelationship() {
        return cat_relationship::all();
    }

    public function getUserTypes() {
        return cat_user_types::all();
    }


 }