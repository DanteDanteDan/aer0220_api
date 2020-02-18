<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _payments extends Model
{
    protected $table = 'aer0220_payments'; // Table Name

    public function paymentStudent() // FK student_id
    {
        return $this->belongsTo('App\Models\_students', 'student_id', 'student_id');
    }

    public function paymentTypes() // FK payment_types_id
    {
        return $this->belongsTo('App\Models\cat_payment_types', 'payment_types_id', 'payment_types_id');
    }

    public function paymentStatus() // FK payment_status_id
    {
        return $this->belongsTo('App\Models\cat_payment_status', 'payment_status_id', 'payment_status_id');
    }
}
