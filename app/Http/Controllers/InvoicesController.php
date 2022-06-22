<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerField;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function create()
    {
        $customers = Customer::latest()->get();
        return view('invoices.create', compact('customers'));
    }

    public function store(Request $request)
    {
        // dd($request->customer);
        // dd($request->invoice);  

        // $customer = Customer::create($request->customer);

        $invoice = Invoice::create($request->invoice);
        for ($i = 0; $i < count($request->product); $i++) {
            if (isset($request->quantity[$i]) && isset($request->price[$i])) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'name' => $request->product[$i],
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                ]);
            }
        }

        // for ($i = 0; $i < count($request->customer_fields); $i++) {
        //     if (isset($request->customer_fields[$i]['field_key']) && isset($request->customer_fields[$i]['field_value'])) {
        //         CustomerField::create([
        //             'customer_id' => $customer->id,
        //             'field_key' => $request->customer_fields[$i]['field_key'],
        //             'field_value' => $request->customer_fields[$i]['field_value'],
        //         ]);
        //     }
        // }
        return route('home');
    }

    public function show(Invoice $invoice)
    {
        // dd($invoice->id);
        return view('invoices.show', compact('invoice'));
    }

    public function download($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        // dd($invoice->all());
        $pdf = FacadePdf::loadView('invoices.pdf', compact('invoice'));

        return $pdf->download('invoice.pdf');
    }
}
