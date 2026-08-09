@extends('admin.base')

@section('content')
    <div class="container-fluid">

        {{-- ================= HEADER ================= --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1">
                    {{ $client->name }}
                </h4>

                <p class="text-muted mb-0">
                    Client Details
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('clients.edit', $client) }}" class="btn btn-outline-secondary">
                    Edit Client
                </a>

                <a href="{{ route('clients.index') }}" class="btn btn-light">
                    Back
                </a>

            </div>

        </div>


        {{-- ================= CLIENT INFORMATION ================= --}}
        <div class="card mb-4">

            <div class="card-header">
                <h5 class="mb-0">
                    Client Information
                </h5>
            </div>

            <div class="card-body">

                <div class="row g-4">

                    {{-- Name --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Client Name
                        </small>

                        <strong>
                            {{ $client->name }}
                        </strong>

                    </div>


                    {{-- Phone --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Phone
                        </small>

                        <strong>
                            {{ $client->phone ?? '-' }}
                        </strong>

                    </div>


                    {{-- Email --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Email
                        </small>

                        <strong>
                            {{ $client->email ?? '-' }}
                        </strong>

                    </div>


                    {{-- Passport --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Passport Number
                        </small>

                        <strong>
                            {{ $client->passport_no ?? '-' }}
                        </strong>

                    </div>


                    {{-- Passport Expiry --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Passport Expiry
                        </small>

                        <strong>
                            {{ $client->passport_expiry?->format('d M Y') ?? '-' }}
                        </strong>

                    </div>


                    {{-- Date of Birth --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Date of Birth
                        </small>

                        <strong>
                            {{ $client->date_of_birth?->format('d M Y') ?? '-' }}
                        </strong>

                    </div>


                    {{-- Gender --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Gender
                        </small>

                        <strong>
                            {{ ucfirst($client->gender ?? '-') }}
                        </strong>

                    </div>


                    {{-- Nationality --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Nationality
                        </small>

                        <strong>
                            {{ $client->nationality ?? '-' }}
                        </strong>

                    </div>


                    {{-- Address --}}
                    <div class="col-md-4">

                        <small class="text-muted d-block">
                            Address
                        </small>

                        <strong>
                            {{ $client->address ?? '-' }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================= VISAS ================= --}}
        <div class="card mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="mb-0">
                        Visa Applications
                    </h5>

                    <small class="text-muted">
                        {{ $client->visas->count() }} visa(s)
                    </small>

                </div>

                {{-- We will connect this later --}}
                <a href="{{ route('clients.addVisa', $client) }}" class="btn btn-primary btn-sm">
                    + Add Visa
                </a>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Country</th>

                                <th>Visa Type</th>

                                <th>Status</th>

                                <th>Application No.</th>

                                <th>Application Date</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($client->visas as $index => $visa)
                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>


                                    <td>
                                        {{ $visa->country }}
                                    </td>


                                    <td>
                                        {{ $visa->visaType?->name ?? '-' }}
                                    </td>


                                    <td>

                                        @if ($visa->visaStatus)
                                            <span class="badge"
                                                @if ($visa->visaStatus->color) style="background-color: {{ $visa->visaStatus->color }}" @endif>
                                                {{ $visa->visaStatus->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">
                                                -
                                            </span>
                                        @endif

                                    </td>


                                    <td>
                                        {{ $visa->application_no ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $visa->application_date?->format('d M Y') ?? '-' }}
                                    </td>


                                    <td>

                                        <button type="button" class="btn btn-sm btn-outline-primary">
                                            View
                                        </button>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <div class="text-muted mb-3">
                                            No visa applications found.
                                        </div>

                                        <a href="{{ route('clients.addVisa', $client) }}" class="btn btn-primary btn-sm">
                                            + Add First Visa
                                        </a>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- ================= FUTURE SECTIONS ================= --}}

        <div class="row g-4">

            {{-- Services --}}
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-0">
                                Services
                            </h5>

                            <small class="text-muted">
                                {{ $client->services->count() }} service(s)
                            </small>

                        </div>

                        <a href="{{ route('clients.addService', $client) }}" class="btn btn-sm btn-primary">
                            + Add Service
                        </a>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th>#</th>

                                        <th>Service</th>

                                        <th>Related Visa</th>

                                        <th>Price</th>

                                        <th>Qty</th>

                                        <th>Total</th>

                                        <th>Service Date</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($client->services as $index => $clientService)
                                        <tr>

                                            {{-- # --}}
                                            <td>
                                                {{ $index + 1 }}
                                            </td>


                                            {{-- Service --}}
                                            <td>

                                                <strong>
                                                    {{ $clientService->service?->name ?? '-' }}
                                                </strong>

                                                @if ($clientService->service?->description)
                                                    <small class="text-muted d-block">
                                                        {{ $clientService->service->description }}
                                                    </small>
                                                @endif

                                            </td>


                                            {{-- Related Visa --}}
                                            <td>

                                                @if ($clientService->visa)
                                                    {{ $clientService->visa->country }}

                                                    @if ($clientService->visa->visaType)
                                                        -
                                                        {{ $clientService->visa->visaType->name }}
                                                    @endif
                                                @else
                                                    <span class="text-muted">
                                                        Not linked
                                                    </span>
                                                @endif

                                            </td>


                                            {{-- Price --}}
                                            <td>

                                                {{ number_format($clientService->price, 2) }}

                                            </td>


                                            {{-- Quantity --}}
                                            <td>

                                                {{ $clientService->quantity }}

                                            </td>


                                            {{-- Total --}}
                                            <td>

                                                <strong>
                                                    {{ number_format($clientService->price * $clientService->quantity, 2) }}
                                                </strong>

                                            </td>


                                            {{-- Date --}}
                                            <td>

                                                {{ $clientService->service_date?->format('d M Y') ?? '-' }}

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="7" class="text-center py-5">

                                                <div class="text-muted mb-3">
                                                    No services found.
                                                </div>

                                                <a href="{{ route('clients.addService', $client) }}"
                                                    class="btn btn-sm btn-primary">
                                                    + Add First Service
                                                </a>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Invoices --}}
            <div class="col-md-12 mt-4">

                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="mb-0">
                                Invoices
                            </h5>

                            <small class="text-muted">
                                {{ $client->invoices->count() }} invoice(s)
                            </small>
                        </div>

                        <a href="{{ route('clients.createInvoice', $client) }}" class="btn btn-sm btn-primary">
                            + Create Invoice
                        </a>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($client->invoices as $invoice)
                                        @php
                                            $paid = $invoice->paymentAllocations->sum('amount');

                                            $due = max(0, $invoice->total - $paid);
                                        @endphp

                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>


                                            <td>

                                                <strong>
                                                    {{ $invoice->invoice_number }}
                                                </strong>

                                            </td>


                                            <td>
                                                {{ $invoice->invoice_date?->format('d M Y') }}
                                            </td>


                                            <td>
                                                {{ number_format($invoice->total, 2) }}
                                            </td>


                                            <td class="text-success">
                                                {{ number_format($paid, 2) }}
                                            </td>


                                            <td class="text-danger">
                                                {{ number_format($due, 2) }}
                                            </td>


                                            <td>

                                                @if ($due <= 0 && $invoice->total > 0)
                                                    <span class="badge bg-success">
                                                        Paid
                                                    </span>
                                                @elseif($paid > 0)
                                                    <span class="badge bg-warning text-dark">
                                                        Partial
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Unpaid
                                                    </span>
                                                @endif

                                            </td>
                                            <td>

                                                @if ($due > 0)
                                                    <a href="{{ route('clients.createPayment', [
                                                        'client' => $client,
                                                        'invoice' => $invoice,
                                                    ]) }}"
                                                        class="btn btn-sm btn-success">
                                                        + Payment
                                                    </a>
                                                    <a href="{{ route('clients.showInvoice', [
                                                        'client' => $client,
                                                        'invoice' => $invoice,
                                                    ]) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        View
                                                    </a>
                                                @else
                                                    <span class="text-muted">
                                                        Paid
                                                    </span>
                                                @endif

                                            </td>



                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="8" class="text-center py-5 text-muted">
                                                No invoices found.
                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Payments --}}
            {{-- ================= PAYMENT HISTORY ================= --}}
            <div class="col-md-12 mt-4">

                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="mb-0">
                                Payment History
                            </h5>

                            <small class="text-muted">
                                {{ $client->payments->count() }} payment(s)
                            </small>
                        </div>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Transaction ID</th>
                                        <th>Reference</th>
                                        <th>Invoice</th>
                                        <th>Receipt</th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($client->payments as $payment)
                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>


                                            <td>
                                                {{ $payment->payment_date?->format('d M Y') }}
                                            </td>


                                            <td>

                                                <strong class="text-success">
                                                    {{ number_format($payment->amount, 2) }}
                                                </strong>

                                            </td>


                                            <td>

                                                <span class="badge bg-light text-dark">
                                                    {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                </span>

                                            </td>


                                            <td>
                                                {{ $payment->transaction_id ?? '-' }}
                                            </td>


                                            <td>
                                                {{ $payment->reference ?? '-' }}
                                            </td>


                                            <td>

                                                @forelse($payment->allocations as $allocation)
                                                    <span class="badge bg-primary">
                                                        {{ $allocation->invoice?->invoice_number ?? '-' }}
                                                    </span>

                                                @empty

                                                    -
                                                @endforelse

                                            </td>
                                            <td>

                                                <a href="{{ route('clients.paymentReceipt', [
                                                    'client' => $client,
                                                    'payment' => $payment,
                                                ]) }}"
                                                    class="btn btn-sm btn-outline-primary">

                                                    Receipt

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="7" class="text-center py-5 text-muted">
                                                No payment found.
                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
