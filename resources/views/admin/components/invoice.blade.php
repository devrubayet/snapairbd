@extends('admin.base')

@section('content')

    <div class="container-fluid">

        {{-- ================= HEADER ================= --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1">
                    Invoice
                </h4>

                <p class="text-muted mb-0">
                    {{ $invoice->invoice_number }}
                </p>
            </div>


            <div class="d-flex gap-2">

                <a href="{{ route('clients.show', $client) }}"
                    class="btn btn-light">
                    Back
                </a>


                @if ($due > 0)

                    <a href="{{ route('clients.createPayment', [
                        'client' => $client,
                        'invoice' => $invoice,
                    ]) }}"
                        class="btn btn-success">

                        + Add Payment

                    </a>

                @endif


                <button
                    type="button"
                    onclick="window.print()"
                    class="btn btn-primary">

                    Print Invoice

                </button>

            </div>

        </div>


        {{-- ================= INVOICE ================= --}}
        <div class="card" id="printableInvoice">

            <div class="card-body p-5">


                {{-- ================= COMPANY HEADER ================= --}}
                <div class="row align-items-start mb-5">

                    <div class="col-md-7">

                        {{-- Replace with your company logo --}}
                        <h3 class="fw-bold mb-1">
                            Your Company Name
                        </h3>

                        <p class="text-muted mb-0">
                            Visa & Travel Services
                        </p>

                        <p class="text-muted mb-0">
                            Phone: +880XXXXXXXXXX
                        </p>

                        <p class="text-muted mb-0">
                            Email: info@example.com
                        </p>

                    </div>


                    <div class="col-md-5 text-md-end">

                        <h2 class="fw-bold mb-2">
                            INVOICE
                        </h2>


                        <p class="mb-1">

                            <strong>
                                Invoice No:
                            </strong>

                            {{ $invoice->invoice_number }}

                        </p>


                        <p class="mb-1">

                            <strong>
                                Invoice Date:
                            </strong>

                            {{ $invoice->invoice_date?->format('d M Y') }}

                        </p>


                        @if ($invoice->due_date)

                            <p class="mb-1">

                                <strong>
                                    Due Date:
                                </strong>

                                {{ $invoice->due_date->format('d M Y') }}

                            </p>

                        @endif

                    </div>

                </div>


                <hr>


                {{-- ================= BILL TO ================= --}}
                <div class="row my-4">

                    <div class="col-md-6">

                        <h6 class="text-uppercase text-muted">
                            Bill To
                        </h6>


                        <h5 class="fw-bold mb-1">
                            {{ $client->name }}
                        </h5>


                        <p class="mb-1">

                            Phone:
                            {{ $client->phone ?? '-' }}

                        </p>


                        <p class="mb-1">

                            Passport:
                            {{ $client->passport_no ?? '-' }}

                        </p>

                    </div>


                    <div class="col-md-6 text-md-end">

                        <h6 class="text-uppercase text-muted">
                            Payment Status
                        </h6>


                        @if ($due <= 0 && $invoice->total > 0)

                            <span class="badge bg-success fs-6">
                                PAID
                            </span>

                        @elseif($paid > 0)

                            <span class="badge bg-warning text-dark fs-6">
                                PARTIAL
                            </span>

                        @else

                            <span class="badge bg-danger fs-6">
                                UNPAID
                            </span>

                        @endif

                    </div>

                </div>


                {{-- ================= ITEMS ================= --}}
                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th width="50">
                                    #
                                </th>


                                <th>
                                    Description
                                </th>


                                <th>
                                    Related Visa
                                </th>


                                <th class="text-center">
                                    Qty
                                </th>


                                <th class="text-end">
                                    Unit Price
                                </th>


                                <th class="text-end">
                                    Total
                                </th>


                                <th class="text-end">
                                    Paid
                                </th>


                                <th class="text-end">
                                    Due
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($invoice->items as $item)

                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | Item Paid
                                    |--------------------------------------------------------------------------
                                    */

                                    $itemPaid = $item->paymentAllocations
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

                                @endphp


                                <tr>

                                    {{-- # --}}
                                    <td>

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- Description --}}
                                    <td>

                                        <strong>
                                            {{ $item->description }}
                                        </strong>


                                        @if ($item->service)

                                            <small class="text-muted d-block">

                                                {{ $item->service->name }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- Related Visa --}}
                                    <td>

                                        @if ($item->visa)

                                            {{ $item->visa->country }}


                                            @if ($item->visa->visaType)

                                                <small class="text-muted d-block">

                                                    {{ $item->visa->visaType->name }}

                                                </small>

                                            @endif

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Quantity --}}
                                    <td class="text-center">

                                        {{ number_format(
                                            $item->quantity,
                                            2
                                        ) }}

                                    </td>


                                    {{-- Unit Price --}}
                                    <td class="text-end">

                                        {{ number_format(
                                            $item->unit_price,
                                            2
                                        ) }}

                                    </td>


                                    {{-- Total --}}
                                    <td class="text-end fw-semibold">

                                        {{ number_format(
                                            $item->total,
                                            2
                                        ) }}

                                    </td>


                                    {{-- Paid --}}
                                    <td class="text-end text-success">

                                        {{ number_format(
                                            $itemPaid,
                                            2
                                        ) }}

                                    </td>


                                    {{-- Due --}}
                                    <td class="text-end text-danger">

                                        {{ number_format(
                                            $itemDue,
                                            2
                                        ) }}

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="text-center py-4 text-muted">

                                        No invoice items found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ================= TOTALS ================= --}}
                <div class="row justify-content-end mt-4">

                    <div class="col-md-5">

                        <table class="table table-sm">

                            {{-- Subtotal --}}
                            <tr>

                                <td>
                                    Subtotal
                                </td>

                                <td class="text-end">

                                    {{ number_format(
                                        $invoice->subtotal,
                                        2
                                    ) }}

                                </td>

                            </tr>


                            {{-- Discount --}}
                            <tr>

                                <td>
                                    Discount
                                </td>

                                <td class="text-end">

                                    {{ number_format(
                                        $invoice->discount,
                                        2
                                    ) }}

                                </td>

                            </tr>


                            {{-- Tax --}}
                            <tr>

                                <td>
                                    Tax
                                </td>

                                <td class="text-end">

                                    {{ number_format(
                                        $invoice->tax,
                                        2
                                    ) }}

                                </td>

                            </tr>


                            {{-- Grand Total --}}
                            <tr class="fw-bold fs-5">

                                <td>
                                    Grand Total
                                </td>

                                <td class="text-end">

                                    {{ number_format(
                                        $invoice->total,
                                        2
                                    ) }}

                                </td>

                            </tr>


                            {{-- Paid --}}
                            <tr class="text-success">

                                <td>
                                    Paid
                                </td>

                                <td class="text-end">

                                    {{ number_format(
                                        $paid,
                                        2
                                    ) }}

                                </td>

                            </tr>


                            {{-- Due --}}
                            <tr class="text-danger fw-bold">

                                <td>
                                    Due
                                </td>

                                <td class="text-end">

                                    {{ number_format(
                                        $due,
                                        2
                                    ) }}

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>


                {{-- ================= PAYMENT HISTORY ================= --}}
                @if ($invoice->paymentAllocations->count())

                    <div class="mt-5">

                        <h6 class="fw-bold mb-3">
                            Payment History
                        </h6>


                        <div class="table-responsive">

                            <table class="table table-sm table-bordered">

                                <thead class="table-light">

                                    <tr>

                                        <th>
                                            Date
                                        </th>


                                        <th>
                                            Method
                                        </th>


                                        <th>
                                            Transaction ID
                                        </th>


                                        <th class="text-end">
                                            Amount
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach (
                                        $invoice->paymentAllocations
                                        as $allocation
                                    )

                                        <tr>

                                            {{-- Date --}}
                                            <td>

                                                {{ $allocation->payment?->payment_date?->format('d M Y') ?? '-' }}

                                            </td>


                                            {{-- Method --}}
                                            <td>

                                                {{ $allocation->payment?->payment_method ?? '-' }}

                                            </td>


                                            {{-- Transaction ID --}}
                                            <td>

                                                {{ $allocation->payment?->transaction_id ?? '-' }}

                                            </td>


                                            {{-- Amount --}}
                                            <td class="text-end">

                                                {{ number_format(
                                                    $allocation->amount,
                                                    2
                                                ) }}

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                @endif


                {{-- ================= NOTES ================= --}}
                @if ($invoice->notes)

                    <div class="mt-4">

                        <h6 class="fw-bold">
                            Notes
                        </h6>


                        <p class="text-muted mb-0">

                            {{ $invoice->notes }}

                        </p>

                    </div>

                @endif


                {{-- ================= FOOTER ================= --}}
                <div class="text-center text-muted mt-5 pt-4 border-top">

                    <small>
                        Thank you for your business.
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- ================= PRINT CSS ================= --}}
    <style>

        @media print {

            body * {
                visibility: hidden;
            }


            #printableInvoice,
            #printableInvoice * {
                visibility: visible;
            }


            #printableInvoice {

                position: absolute;

                left: 0;

                top: 0;

                width: 100%;

                border: none !important;

                box-shadow: none !important;

            }


            .btn {
                display: none !important;
            }


            .card {
                border: none !important;
            }


            @page {
                margin: 12mm;
            }

        }

    </style>

@endsection