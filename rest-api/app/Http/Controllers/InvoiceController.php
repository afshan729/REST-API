<?php
namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::query();
        // Apply filters
        if ($request->has('customer_name')) {
            $invoices->where('customer_name', 'LIKE', '%' . $request->input('customer_name') . '%');
        }
        if ($request->has('salesperson')) {
          $invoices->where('salesperson', $request->input('salesperson'));
          
        }
        if ($request->has('photographer')) {
            $invoices->where('photographer', $request->input('photographer'));
        }

        $filteredInvoices = $invoices->get();

        // Return the filtered invoices to the view
        return view('invoices.index', ['invoices' => $filteredInvoices]);
    }
}

