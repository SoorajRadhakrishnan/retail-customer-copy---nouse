<?php

namespace App\Listeners;

use App\Events\PaymentTransactionEvent;
use App\Models\PaymentTranscation;

class LogPaymentTransaction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentTransactionEvent $event): void
    {
        if($event->delete) {
            PaymentTranscation::where('ref_no', $event->refNo)->where('status', $event->status)->delete();
            return;
        }

        if($event->update) {
            PaymentTranscation::where('ref_no', $event->refNo)->where('status', $event->status)->update([
                'payment_type' => $event->paymentType,
            ]);
            return;
        }

        PaymentTranscation::create([
            'payment_type' => $event->paymentType,
            'type' => $event->type,
            'status' => $event->status,
            'amount' => $event->amount,
            'branch_id' => $event->branchId,
            'user_id' => auth()->user()->id,
            'ref_no' => $event->refNo,
        ]);
    }
}
