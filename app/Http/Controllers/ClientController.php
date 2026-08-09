<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\VisaStatus;
use App\Models\VisaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display all clients.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $clients = Client::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('passport_no', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.all-clients', compact('clients', 'search'));
    }

    /**
     * Show create client form.
     */
    public function create()
    {
        $visaTypes = VisaType::where('status', 'active')
            ->orderBy('name')
            ->get();

        $visaStatuses = VisaStatus::where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        return view('admin.components.createclient', compact(
            'visaTypes',
            'visaStatuses'
        ));
    }

    /**
     * Store client + multiple visas.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Client
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:50'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'passport_no' => ['nullable', 'string', 'max:100'],
            'passport_expiry' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
            'emergency_phone' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],

            // Visas
            'visas' => ['nullable', 'array'],

            'visas.*.visa_type_id' => [
                'required',
                'exists:visa_types,id',
            ],

            'visas.*.visa_status_id' => [
                'required',
                'exists:visa_statuses,id',
            ],

            'visas.*.country' => [
                'required',
                'string',
                'max:100',
            ],

            'visas.*.application_no' => [
                'nullable',
                'string',
                'max:100',
            ],

            'visas.*.application_date' => [
                'nullable',
                'date',
            ],

            'visas.*.submission_date' => [
                'nullable',
                'date',
            ],

            'visas.*.approval_date' => [
                'nullable',
                'date',
            ],

            'visas.*.expiry_date' => [
                'nullable',
                'date',
            ],

            'visas.*.notes' => [
                'nullable',
                'string',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            // Create client
            $client = Client::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'] ?? null,
                'email' => $validated['email'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'nationality' => $validated['nationality'] ?? null,
                'passport_no' => $validated['passport_no'] ?? null,
                'passport_expiry' => $validated['passport_expiry'] ?? null,
                'address' => $validated['address'] ?? null,
                'city' => $validated['city'] ?? null,
                'country' => $validated['country'] ?? null,
                'emergency_contact' => $validated['emergency_contact'] ?? null,
                'emergency_phone' => $validated['emergency_phone'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create all visas
            foreach ($validated['visas'] ?? [] as $visaData) {
                $client->visas()->create([
                    'visa_type_id' => $visaData['visa_type_id'],
                    'visa_status_id' => $visaData['visa_status_id'],
                    'country' => $visaData['country'],
                    'application_no' => $visaData['application_no'] ?? null,
                    'application_date' => $visaData['application_date'] ?? null,
                    'submission_date' => $visaData['submission_date'] ?? null,
                    'approval_date' => $visaData['approval_date'] ?? null,
                    'expiry_date' => $visaData['expiry_date'] ?? null,
                    'notes' => $visaData['notes'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display client details.
     */



    public function addVisa(Client $client)
    {
        $visaTypes = VisaType::where('status', 'active')
            ->orderBy('name')
            ->get();

        $visaStatuses = VisaStatus::where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        return view('admin.pages.add-visa', compact(
            'client',
            'visaTypes',
            'visaStatuses'
        ));
    }


    public function storeVisa(Request $request, Client $client)
    {
        $validated = $request->validate([
            'visa_type_id' => [
                'required',
                'exists:visa_types,id',
            ],

            'visa_status_id' => [
                'required',
                'exists:visa_statuses,id',
            ],

            'country' => [
                'required',
                'string',
                'max:100',
            ],

            'application_no' => [
                'nullable',
                'string',
                'max:100',
            ],

            'application_date' => [
                'nullable',
                'date',
            ],

            'submission_date' => [
                'nullable',
                'date',
            ],

            'approval_date' => [
                'nullable',
                'date',
            ],

            'expiry_date' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $client->visas()->create($validated);

        return redirect()
            ->route('clients.show', $client)
            ->with('success', 'Visa added successfully.');
    }


    public function show(Client $client)
    {
        $client->load([
            'visas.visaType',
            'visas.visaStatus',

            'services.service',
            'services.visa.visaType',

            'invoices.items.service',
            'invoices.items.visa',
            'invoices.paymentAllocations',

            'payments.allocations.invoice',
        ]);

        return view('admin.pages.client-overview', compact('client'));
    }
    /**
     * Show edit client form.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update client.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:50'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'passport_no' => ['nullable', 'string', 'max:100'],
            'passport_expiry' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
            'emergency_phone' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);

        $client->update($validated);

        return redirect()
            ->route('clients.show', $client)
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Delete client.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    public function addService(Client $client)
    {
        $services = \App\Models\Service::where('status', 'active')
            ->orderBy('name')
            ->get();

        $visas = $client->visas()
            ->with(['visaType', 'visaStatus'])
            ->latest()
            ->get();

        return view('admin.pages.add-service', compact(
            'client',
            'services',
            'visas'
        ));
    }


    public function storeService(Request $request, Client $client)
    {
        $validated = $request->validate([
            'service_id' => [
                'required',
                'exists:services,id',
            ],

            'visa_id' => [
                'nullable',
                'exists:visas,id',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'service_date' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        // Make sure selected visa actually belongs to this client
        if (!empty($validated['visa_id'])) {

            $visaExists = $client->visas()
                ->where('id', $validated['visa_id'])
                ->exists();

            if (!$visaExists) {
                return back()
                    ->withErrors([
                        'visa_id' => 'Selected visa does not belong to this client.',
                    ])
                    ->withInput();
            }
        }

        $client->services()->create($validated);

        return redirect()
            ->route('clients.show', $client)
            ->with('success', 'Service added successfully.');
    }

    public function createInvoice(Client $client)
    {
        $client->load([
            'services.service',
            'services.visa.visaType',
            'services.visa.visaStatus',
        ]);

        return view('admin.components.create-invoice', compact('client'));
    }
    public function storeInvoice(Request $request, Client $client)
    {
        $validated = $request->validate([
            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*' => [
                'required',
                'string',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'invoice_date' => [
                'required',
                'date',
            ],

            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:invoice_date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);


        /*
    |--------------------------------------------------------------------------
    | Load Client Services
    |--------------------------------------------------------------------------
    */

        $client->load([
            'services.service',
            'services.visa.visaType',
        ]);


        $invoiceItems = [];

        $subtotal = 0;


        /*
    |--------------------------------------------------------------------------
    | Process Selected Services
    |--------------------------------------------------------------------------
    */

        foreach ($validated['items'] as $item) {

            /*
        |--------------------------------------------------------------------------
        | Only service items are accepted
        |--------------------------------------------------------------------------
        */

            if (!str_starts_with($item, 'service:')) {

                return back()
                    ->withErrors([
                        'items' => 'Invalid invoice item selected.',
                    ])
                    ->withInput();
            }


            $clientServiceId = (int) str_replace(
                'service:',
                '',
                $item
            );


            /*
        |--------------------------------------------------------------------------
        | Make sure service belongs to this client
        |--------------------------------------------------------------------------
        */

            $clientService = $client->services
                ->firstWhere('id', $clientServiceId);


            if (!$clientService) {

                return back()
                    ->withErrors([
                        'items' => 'Invalid service selected.',
                    ])
                    ->withInput();
            }


            /*
        |--------------------------------------------------------------------------
        | Calculate Item Total
        |--------------------------------------------------------------------------
        */

            $quantity = (float) $clientService->quantity;

            $unitPrice = (float) $clientService->price;

            $itemTotal = $quantity * $unitPrice;


            /*
        |--------------------------------------------------------------------------
        | Description
        |--------------------------------------------------------------------------
        */

            $description = $clientService->service?->name
                ?? 'Service';


            if ($clientService->visa) {

                $description .= ' - '
                    . $clientService->visa->country;

                if ($clientService->visa->visaType) {

                    $description .= ' - '
                        . $clientService->visa->visaType->name;
                }
            }


            /*
        |--------------------------------------------------------------------------
        | Prepare Invoice Item
        |--------------------------------------------------------------------------
        */

            $invoiceItems[] = [

                'service_id' => $clientService->service_id,

                'visa_id' => $clientService->visa_id,

                'description' => $description,

                'quantity' => $quantity,

                'unit_price' => $unitPrice,

                'total' => $itemTotal,

            ];


            $subtotal += $itemTotal;
        }


        /*
    |--------------------------------------------------------------------------
    | Discount
    |--------------------------------------------------------------------------
    */

        $discount = (float) ($validated['discount'] ?? 0);


        if ($discount > $subtotal) {

            $discount = $subtotal;
        }


        /*
    |--------------------------------------------------------------------------
    | Tax
    |--------------------------------------------------------------------------
    */

        $tax = (float) ($validated['tax'] ?? 0);


        /*
    |--------------------------------------------------------------------------
    | Final Total
    |--------------------------------------------------------------------------
    */

        $total = $subtotal - $discount + $tax;


        if ($total < 0) {

            $total = 0;
        }


        /*
    |--------------------------------------------------------------------------
    | Generate Invoice Number
    |--------------------------------------------------------------------------
    */

        $invoiceNumber =
            'INV-' . now()->format('YmdHis');


        /*
    |--------------------------------------------------------------------------
    | Create Invoice
    |--------------------------------------------------------------------------
    */

        $invoice = \App\Models\Invoice::create([

            'client_id' => $client->id,

            'invoice_number' => $invoiceNumber,

            'invoice_date' => $validated['invoice_date'],

            'due_date' => $validated['due_date'] ?? null,

            'subtotal' => $subtotal,

            'discount' => $discount,

            'tax' => $tax,

            'total' => $total,

            'status' => 'unpaid',

            'notes' => $validated['notes'] ?? null,

        ]);


        /*
    |--------------------------------------------------------------------------
    | Create Invoice Items
    |--------------------------------------------------------------------------
    */

        foreach ($invoiceItems as $item) {

            $invoice->items()->create($item);
        }


        /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

        return redirect()
            ->route('clients.show', $client)
            ->with(
                'success',
                'Invoice ' .
                    $invoice->invoice_number .
                    ' created successfully.'
            );
    }




    public function createPayment(Client $client, Invoice $invoice)
    {
        if ($invoice->client_id !== $client->id) {
            abort(404);
        }

        $invoice->load([
            'items.service',
            'items.visa.visaType',
            'paymentAllocations',
        ]);

        $paid = $invoice->paymentAllocations->sum('amount');

        $due = max(
            0,
            (float) $invoice->total - (float) $paid
        );

        return view(
            'admin.pages.create-payment',
            compact(
                'client',
                'invoice',
                'paid',
                'due'
            )
        );
    }

    public function storePayment(
        Request $request,
        Client $client,
        Invoice $invoice
    ) {
        /*
    |--------------------------------------------------------------------------
    | Verify Invoice Belongs To Client
    |--------------------------------------------------------------------------
    */

        if ($invoice->client_id !== $client->id) {
            abort(404);
        }


        /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

        $validated = $request->validate([

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'payment_method' => [
                'required',
                'string',
                'max:50',
            ],

            'transaction_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'reference' => [
                'nullable',
                'string',
                'max:255',
            ],

            'payment_date' => [
                'required',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'allocation_type' => [
                'required',
                'in:invoice,items',
            ],

            'allocations' => [
                'nullable',
                'array',
            ],

            'allocations.*' => [
                'nullable',
                'numeric',
                'min:0',
            ],

        ]);


        /*
    |--------------------------------------------------------------------------
    | Current Paid & Due
    |--------------------------------------------------------------------------
    */

        $paid = $invoice->paymentAllocations()
            ->sum('amount');


        $due = max(
            0,
            (float) $invoice->total - (float) $paid
        );


        $paymentAmount = (float) $validated['amount'];


        /*
    |--------------------------------------------------------------------------
    | Prevent Overpayment
    |--------------------------------------------------------------------------
    */

        if ($paymentAmount > $due) {

            return back()
                ->withErrors([
                    'amount' =>
                    'Payment cannot be greater than the invoice due amount.',
                ])
                ->withInput();
        }


        /*
    |--------------------------------------------------------------------------
    | Prepare Allocations
    |--------------------------------------------------------------------------
    */

        $allocations = [];


        /*
    |--------------------------------------------------------------------------
    | Invoice Level Payment
    |--------------------------------------------------------------------------
    */

        if ($validated['allocation_type'] === 'invoice') {

            $allocations[] = [
                'invoice_item_id' => null,
                'amount' => $paymentAmount,
            ];
        }


        /*
    |--------------------------------------------------------------------------
    | Item Level Payment
    |--------------------------------------------------------------------------
    */

        if ($validated['allocation_type'] === 'items') {

            $submittedAllocations = $validated['allocations'] ?? [];

            $allocationTotal = 0;


            foreach ($submittedAllocations as $itemId => $amount) {

                $amount = (float) $amount;

                if ($amount <= 0) {
                    continue;
                }


                /*
        |--------------------------------------------------------------------------
        | Find Invoice Item
        |--------------------------------------------------------------------------
        */

                $item = $invoice->items()
                    ->where('id', $itemId)
                    ->first();


                if (!$item) {

                    return back()
                        ->withErrors([
                            'allocations' =>
                            'Invalid invoice item selected.',
                        ])
                        ->withInput();
                }


                /*
        |--------------------------------------------------------------------------
        | Already Paid For This Item
        |--------------------------------------------------------------------------
        */

                $itemPaid = \App\Models\PaymentAllocation::query()
                    ->where('invoice_item_id', $item->id)
                    ->sum('amount');


                /*
        |--------------------------------------------------------------------------
        | Item Due
        |--------------------------------------------------------------------------
        */

                $itemDue = max(
                    0,
                    (float) $item->total - (float) $itemPaid
                );


                /*
        |--------------------------------------------------------------------------
        | Prevent Item Overpayment
        |--------------------------------------------------------------------------
        */

                if ($amount > $itemDue) {

                    return back()
                        ->withErrors([
                            'allocations' =>
                            "Payment for {$item->description} cannot be greater than its due amount.",
                        ])
                        ->withInput();
                }


                /*
        |--------------------------------------------------------------------------
        | Add To Allocation Total
        |--------------------------------------------------------------------------
        */

                $allocationTotal += $amount;


                $allocations[] = [

                    'invoice_item_id' => $item->id,

                    'amount' => $amount,

                ];
            }


            /*
    |--------------------------------------------------------------------------
    | Allocation Must Match Payment
    |--------------------------------------------------------------------------
    */

            if (
                abs(
                    $allocationTotal - $paymentAmount
                ) > 0.01
            ) {

                return back()
                    ->withErrors([
                        'allocations' =>
                        'Allocation total must match the payment amount.',
                    ])
                    ->withInput();
            }


            /*
    |--------------------------------------------------------------------------
    | At Least One Allocation Required
    |--------------------------------------------------------------------------
    */

            if (empty($allocations)) {

                return back()
                    ->withErrors([
                        'allocations' =>
                        'Please allocate the payment to at least one item.',
                    ])
                    ->withInput();
            }
        }


        /*
    |--------------------------------------------------------------------------
    | Save Payment + Allocations Together
    |--------------------------------------------------------------------------
    */

        DB::transaction(function () use (
            $client,
            $invoice,
            $validated,
            $paymentAmount,
            $allocations
        ) {

            /*
        |--------------------------------------------------------------------------
        | Create Payment
        |--------------------------------------------------------------------------
        */

            $payment = Payment::create([

                'client_id' => $client->id,

                'amount' => $paymentAmount,

                'payment_method' =>
                $validated['payment_method'],

                'transaction_id' =>
                $validated['transaction_id'] ?? null,

                'reference' =>
                $validated['reference'] ?? null,

                'payment_date' =>
                $validated['payment_date'],

                'notes' =>
                $validated['notes'] ?? null,

            ]);


            /*
        |--------------------------------------------------------------------------
        | Create Payment Allocations
        |--------------------------------------------------------------------------
        */

            foreach ($allocations as $allocation) {

                $payment->allocations()->create([

                    'invoice_id' =>
                    $invoice->id,

                    'invoice_item_id' =>
                    $allocation['invoice_item_id'],

                    'amount' =>
                    $allocation['amount'],

                ]);
            }


            /*
        |--------------------------------------------------------------------------
        | Calculate New Paid & Due
        |--------------------------------------------------------------------------
        */

            $newPaid = $invoice->paymentAllocations()
                ->sum('amount');


            $newDue = max(
                0,
                (float) $invoice->total - (float) $newPaid
            );


            /*
        |--------------------------------------------------------------------------
        | Update Invoice Status
        |--------------------------------------------------------------------------
        */

            if ($newDue <= 0) {

                $invoice->update([
                    'status' => 'paid',
                ]);
            } elseif ($newPaid > 0) {

                $invoice->update([
                    'status' => 'partial',
                ]);
            } else {

                $invoice->update([
                    'status' => 'unpaid',
                ]);
            }
        });


        /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

        return redirect()
            ->route(
                'clients.showInvoice',
                [
                    'client' => $client,
                    'invoice' => $invoice,
                ]
            )
            ->with(
                'success',
                'Payment added successfully.'
            );
    }

    public function showInvoice(Client $client, Invoice $invoice)
    {
        if ($invoice->client_id !== $client->id) {
            abort(404);
        }

        $invoice->load([
            'client',
            'items.service',
            'items.visa.visaType',
            'items.paymentAllocations.payment',
            'paymentAllocations.payment',
        ]);

        $paid = $invoice->paymentAllocations->sum('amount');

        $due = max(
            0,
            (float) $invoice->total - (float) $paid
        );

        return view(
            'admin.components.invoice',
            compact(
                'client',
                'invoice',
                'paid',
                'due'
            )
        );
    }

    public function showPaymentReceipt(
    Client $client,
    Payment $payment
) {
    if ($payment->client_id !== $client->id) {
        abort(404);
    }

    $payment->load([
        'allocations.invoice',
        'allocations.invoiceItem.service',
        'allocations.invoiceItem.visa.visaType',
    ]);

    return view(
        'admin.components.payment-receipt',
        compact(
            'client',
            'payment'
        )
    );
}
}
