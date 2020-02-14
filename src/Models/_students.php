<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _students extends Model
{
    protected $table = 'aer0220_students'; // Table Name


    public function studentGrade() // FK grade_id
    {
        return $this->belongsTo('App\Models\cat_grade', 'user_type_id','user_type_id');
    }

    public function studentMeetUs() // FK meet_us_id
    {
        return $this->belongsTo('App\Models\cat_meet_us', 'meet_us_id','meet_us_id');
    }

    public function studentRelationship() // FK relationship_id
    {
        return $this->belongsTo('App\Models\cat_relationship', 'relationship_id','relationship_id');
    }

    public function studentGender() // FK gender_id
    {
        return $this->belongsTo('App\Models\cat_genders', 'gender_id','gender_id');
    }

    public function studentCity() // FK city_id
    {
        return $this->belongsTo('App\Models\cat_cities', 'city_id','city_id');
    }

    public function studentCourses() // FK courses_id
    {
        return $this->belongsTo('App\Models\cat_courses', 'courses_id','courses_id');
    }

    public function studentUserType() // FK user_type_id
    {
        return $this->belongsTo('App\Models\cat_user_types', 'user_type_id','user_type_id');
    }

}