<?php

namespace App\Listeners;

use App\Events\InvoiceProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Invoice;

class StoreInvoice2DB
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InvoiceProcessed  $event
     * @return void
     */
    public function handle(InvoiceProcessed $event)
    {
        $data = $event->invoice_data;

        Invoice::create([
            'order_no' => $data['order_no'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'address' => $data['address'],
            'products' => $data['product'],
        ]);
    }
}
