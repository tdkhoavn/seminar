<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\InvoiceProcessed;

class InvoiceController extends Controller
{
    public function create()
    {
        return view('invoice.create');
    }

    public function save(Request $request)
    {
        $invoice_data = $request->validate([
            'fname' => ['required', 'max:255'],
            'lname' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'address' => ['required', 'max:200'],
            'product.*.name' => ['required', 'max:255'],
            'product.*.amount' => ['required', 'numeric'],
            'product.*.unit_price' => ['required', 'numeric']
        ]);
        $invoice_data['order_no'] = 'K' . date('YmdHis') . rand(10, 100);

        InvoiceProcessed::dispatch($invoice_data);
    }
}
