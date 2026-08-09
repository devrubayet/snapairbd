@extends('admin.base')

@section('content')

    <div class="container-fluid">

        {{-- ================= HEADER ================= --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="mb-1">
                    Payment Receipt
                </h4>

                <p class="text-muted mb-0">
                    Payment #{{ $payment->id }}
                </p>

            </div>


            <div class="d-flex gap-2">

                <a href="{{ url()->previous() }}"
                    class="btn btn-light">

                    Back

                </a>


                <button
                    type="button"
                    onclick="window.print()"
                    class="btn btn-primary">

                    Print Receipt

                </button>

            </div>

        </div>


        {{-- ================= RECEIPT ================= --}}
        <div class="card" id="printableReceipt">

            <div class="card-body p-5">


                {{-- ================= COMPANY HEADER ================= --}}
                <div class="row align-items-start mb-4">

                    <div class="col-md-7">

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
                            PAYMENT RECEIPT
                        </h2>

                        <p class="mb-1">

                            <strong>
                                Receipt No:
                            </strong>

                            PAY-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}

                        </p>

                        <p class="mb-1">

                            <strong>
                                Payment Date:
                            </strong>

                            {{ $payment->payment_date?->format('d M Y') ?? '-' }}

                        </p>

                    </div>

                </div>


                <hr>


                {{-- ================= CLIENT INFORMATION ================= --}}
                <div class="row my-4">

                    <div class="col-md-6">

                        <h6 class="text-uppercase text-muted mb-2">
                            Received From
                        </h6>

                        <h5 class="fw-bold mb-1">
                            {{ $client->name }}
                        </h5>

                        <p class="mb-1">
                            Phone: {{ $client->phone ?? '-' }}
                        </p>

                        <p class="mb-1">
                            Email: {{ $client->email ?? '-' }}
                        </p>

                        <p class="mb-1">
                            Passport: {{ $client->passport_no ?? '-' }}
                        </p>

                    </div>


                    <div class="col-md-6 text-md-end">

                        <h6 class="text-uppercase text-muted mb-2">
                            Payment Amount
                        </h6>

                        <h2 class="fw-bold text-success mb-0">

                            {{ number_format($payment->amount, 2) }}

                        </h2>

                    </div>

                </div>


                {{-- ================= PAYMENT INFORMATION ================= --}}
                <div class="table-responsive mb-4">

                    <table class="table table-bordered">

                        <tbody>

                            <tr>

                                <th width="30%">
                                    Payment Method
                                </th>

                                <td>

                                    {{ ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $payment->payment_method
                                        )
                                    ) }}

                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Transaction ID
                                </th>

                                <td>
                                    {{ $payment->transaction_id ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Reference
                                </th>

                                <td>
                                    {{ $payment->reference ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Payment Date
                                </th>

                                <td>
                                    {{ $payment->payment_date?->format('d M Y') ?? '-' }}
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                {{-- ================= ALLOCATION ================= --}}
                <h6 class="fw-bold mb-3">
                    Payment Allocation
                </h6>


                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    Invoice
                                </th>

                                <th>
                                    Service / Visa
                                </th>

                                <th class="text-end">
                                    Allocated Amount
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($payment->allocations as $allocation)

                                <tr>

                                    {{-- Invoice --}}
                                    <td>

                                        {{ $allocation->invoice?->invoice_number ?? '-' }}

                                    </td>


                                    {{-- Item --}}
                                    <td>

                                        @if ($allocation->invoiceItem)

                                            <strong>
                                                {{ $allocation->invoiceItem->description }}
                                            </strong>


                                            @if ($allocation->invoiceItem->service)

                                                <small class="text-muted d-block">

                                                    Service:
                                                    {{ $allocation->invoiceItem->service->name }}

                                                </small>

                                            @endif


                                            @if ($allocation->invoiceItem->visa)

                                                <small class="text-muted d-block">

                                                    Visa:
                                                    {{ $allocation->invoiceItem->visa->country }}

                                                    @if ($allocation->invoiceItem->visa->visaType)

                                                        -
                                                        {{ $allocation->invoiceItem->visa->visaType->name }}

                                                    @endif

                                                </small>

                                            @endif

                                        @else

                                            <span class="text-muted">
                                                Invoice Level Payment
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Amount --}}
                                    <td class="text-end fw-semibold">

                                        {{ number_format(
                                            $allocation->amount,
                                            2
                                        ) }}

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="text-center text-muted py-4">

                                        No payment allocation found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>


                        <tfoot>

                            <tr class="fw-bold">

                                <td
                                    colspan="2"
                                    class="text-end">

                                    Total Paid

                                </td>

                                <td class="text-end text-success">

                                    {{ number_format(
                                        $payment->amount,
                                        2
                                    ) }}

                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>


                {{-- ================= NOTES ================= --}}
                @if ($payment->notes)

                    <div class="mt-4">

                        <h6 class="fw-bold">
                            Notes
                        </h6>

                        <p class="text-muted mb-0">
                            {{ $payment->notes }}
                        </p>

                    </div>

                @endif


                {{-- ================= FOOTER ================= --}}
                <div class="text-center text-muted mt-5 pt-4 border-top">

                    <small>
                        Thank you for your payment.
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


            #printableReceipt,
            #printableReceipt * {
                visibility: visible;
            }


            #printableReceipt {

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