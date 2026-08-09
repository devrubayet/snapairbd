@extends('admin.base')

@section('title', $settings->site_name . ' | Admin Dashboard')

@section('content')

    <div class="container-fluid">


        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="mb-1">
                    Dashboard
                </h4>

                <p class="text-muted mb-0">
                    Overview of your business
                </p>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- STAT CARDS --}}
        {{-- ========================================================= --}}

        <div class="row">


            {{-- Clients --}}
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <x-admin.card
                    title="Clients"
                    :count="$clientCount"
                    :link="route('clients.index')"
                    desc="All Client List."
                    iconcolor="warning"
                    color="info"
                    icon="mdi-account-group"
                />

            </div>


            {{-- Visas --}}
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <x-admin.card
                    title="Visas"
                    :count="$visaCount"
                    :link="route('clients.index')"
                    desc="Visa Applications."
                    iconcolor="success"
                    color="primary"
                    icon="mdi-passport"
                />

            </div>


            {{-- Invoices --}}
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <x-admin.card
                    title="Invoices"
                    :count="$invoiceCount"
                    :link="route('clients.index')"
                    desc="All Invoices."
                    iconcolor="info"
                    color="warning"
                    icon="mdi-file-document-outline"
                />

            </div>


            {{-- Feedback --}}
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

                <x-admin.card
                    title="Feedback"
                    :count="$feedbackCount"
                    :link="route('all-testi')"
                    desc="Customer Feedback."
                    iconcolor="warning"
                    color="info"
                    icon="mdi-image-multiple"
                />

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- FINANCIAL CARDS --}}
        {{-- ========================================================= --}}

        <div class="row">


            {{-- Invoice Total --}}
            <div class="col-xl-4 col-md-6 grid-margin stretch-card">

                <x-admin.card
                    title="Invoice Total"
                    :count="number_format($invoiceTotal, 2)"
                    :link="route('clients.index')"
                    desc="Total Invoice Amount."
                    iconcolor="primary"
                    color="info"
                    icon="mdi-file-document"
                />

            </div>


            {{-- Paid --}}
            <div class="col-xl-4 col-md-6 grid-margin stretch-card">

                <x-admin.card
                    title="Total Paid"
                    :count="number_format($paidTotal, 2)"
                    :link="route('clients.index')"
                    desc="Total Payment Received."
                    iconcolor="success"
                    color="success"
                    icon="mdi-cash-check"
                />

            </div>


            {{-- Due --}}
            <div class="col-xl-4 col-md-6 grid-margin stretch-card">

                <x-admin.card
                    title="Total Due"
                    :count="number_format($dueTotal, 2)"
                    :link="route('clients.index')"
                    desc="Outstanding Invoice Amount."
                    iconcolor="danger"
                    color="danger"
                    icon="mdi-cash-remove"
                />

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- RECENT DATA --}}
        {{-- ========================================================= --}}

        <div class="row">


            {{-- ===================================================== --}}
            {{-- RECENT INVOICES --}}
            {{-- ===================================================== --}}

            <div class="col-lg-7 grid-margin stretch-card">

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0">
                            Recent Invoices
                        </h5>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th>
                                            Invoice
                                        </th>

                                        <th>
                                            Client
                                        </th>

                                        <th>
                                            Total
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($recentInvoices as $invoice)

                                        @php

                                            $invoicePaid = $invoice->paymentAllocations()
                                                ->sum('amount');

                                            $invoiceDue = max(
                                                0,
                                                (float) $invoice->total -
                                                (float) $invoicePaid
                                            );

                                        @endphp


                                        <tr>

                                            <td>

                                                <strong>
                                                    {{ $invoice->invoice_number }}
                                                </strong>

                                                <small class="text-muted d-block">

                                                    {{ $invoice->invoice_date?->format('d M Y') }}

                                                </small>

                                            </td>


                                            <td>

                                                {{ $invoice->client?->name ?? '-' }}

                                            </td>


                                            <td>

                                                {{ number_format(
                                                    $invoice->total,
                                                    2
                                                ) }}

                                            </td>


                                            <td>

                                                @if ($invoiceDue <= 0 && $invoice->total > 0)

                                                    <span class="badge bg-success">
                                                        Paid
                                                    </span>

                                                @elseif ($invoicePaid > 0)

                                                    <span class="badge bg-warning text-dark">
                                                        Partial
                                                    </span>

                                                @else

                                                    <span class="badge bg-danger">
                                                        Unpaid
                                                    </span>

                                                @endif

                                            </td>

                                        </tr>


                                    @empty

                                        <tr>

                                            <td
                                                colspan="4"
                                                class="text-center py-4 text-muted">

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



            {{-- ===================================================== --}}
            {{-- RECENT PAYMENTS --}}
            {{-- ===================================================== --}}

            <div class="col-lg-5 grid-margin stretch-card">

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0">
                            Recent Payments
                        </h5>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th>
                                            Client
                                        </th>

                                        <th>
                                            Amount
                                        </th>

                                        <th>
                                            Date
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($recentPayments as $allocation)

                                        <tr>

                                            <td>

                                                <strong>
                                                    {{ $allocation->invoice?->client?->name ?? '-' }}
                                                </strong>

                                                <small class="text-muted d-block">

                                                    {{ $allocation->invoice?->invoice_number ?? '-' }}

                                                </small>

                                            </td>


                                            <td>

                                                <strong class="text-success">

                                                    {{ number_format(
                                                        $allocation->amount,
                                                        2
                                                    ) }}

                                                </strong>

                                            </td>


                                            <td>

                                                {{ $allocation->payment?->payment_date?->format('d M Y') ?? '-' }}

                                            </td>

                                        </tr>


                                    @empty

                                        <tr>

                                            <td
                                                colspan="3"
                                                class="text-center py-4 text-muted">

                                                No payments found.

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