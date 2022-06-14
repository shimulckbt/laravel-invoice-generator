<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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

        Customer::create($request->customer);
        return 'ok done';
    }
}
