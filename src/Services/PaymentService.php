<?php

namespace App\Services;

use App\Models\_payments;

class PaymentService {

    // Get ->
    public function getPayments() { // All payments
        return _payments::all();
    }

    public function getPayment() { // One payment

    }

    // Post -> Payments


 }