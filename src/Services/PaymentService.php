<?php

namespace App\Services;

use App\Models\_payments;

class PaymentService
{

    // Get ->
    public function getPayments() // All payments
    {
        $payment = _payments::all();

        foreach ($payment as $item) { // FK
            $item->paymentStudent;
            $item->paymentTypes;
            $item->paymentStatus;
        }

        return $payment;
    }

    public function getPaidPayments($student_id) // All paid payments
    {
        $payment = _payments::all()
                            ->where('student_id', $student_id)
                            ->where('payment_status_id', 2);

        foreach ($payment as $item) { // FK
            $item->paymentStudent;
            $item->paymentTypes;
            $item->paymentStatus;
        }

        return $payment;
    }

    public function getPayment(int $payment_id) // One payment
    {
        $payment = _payments::where('payment_id', $payment_id)
            ->first();

        // FK
        $payment->paymentStudent;
        $payment->paymentTypes;
        $payment->paymentStatus;

        return $payment;
    }

    public function getTotalAmount() // Total Amount
    {

        $result = _payments::sum('amount');

        return $result;
    }

    // Update -> Status Payment
    public function updatePayment($student_id)
    {
        _payments::where('student_id', $student_id)->update(array('payment_status_id' => 1));
    }
}
