<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        // dd($request->customer);
        // dd($request->invoice);

        $customer = Customer::create($request->customer);

        Invoice::create($request->invoice + ['customer_id' => $customer->id]);
        return 'ok done';
    }
}
