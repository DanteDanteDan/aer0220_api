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

    // Update -> Status Payment
    public function updatePayment($payment_id, $obj)
    {
        _payments::where('payment_id', $payment_id)->update(array('payment_status_id' => $obj->payment_status_id));
    }
}
