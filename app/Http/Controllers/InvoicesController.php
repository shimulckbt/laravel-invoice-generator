<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerField;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function create()
    {
        $customers = Customer::latest()->get();
        $products = Product::latest()->get();
        return view('invoices.create', compact('customers', 'products'));
    }



    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function download($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $pdf = FacadePdf::loadView('invoices.pdf', compact('invoice'));

        return $pdf->download('invoice.pdf');
    }
}
