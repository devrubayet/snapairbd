<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\PaymentAllocation;
use App\Models\Testimonial;
use App\Models\Visa;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Basic Counts
        |--------------------------------------------------------------------------
        */

        $feedbackCount = Testimonial::count();

        $clientCount = Client::count();

        $visaCount = Visa::count();

        $invoiceCount = Invoice::count();


        /*
        |--------------------------------------------------------------------------
        | Invoice Financial Summary
        |--------------------------------------------------------------------------
        */

        $invoiceTotal = Invoice::sum('total');

        $paidTotal = PaymentAllocation::sum('amount');

        $dueTotal = max(
            0,
            (float) $invoiceTotal - (float) $paidTotal
        );


        /*
        |--------------------------------------------------------------------------
        | Recent Invoices
        |--------------------------------------------------------------------------
        */

        $recentInvoices = Invoice::with('client')
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Payments
        |--------------------------------------------------------------------------
        */

        $recentPayments = PaymentAllocation::with([
            'payment',
            'invoice.client',
        ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'feedbackCount',
            'clientCount',
            'visaCount',
            'invoiceCount',
            'invoiceTotal',
            'paidTotal',
            'dueTotal',
            'recentInvoices',
            'recentPayments'
        ));
    }
}