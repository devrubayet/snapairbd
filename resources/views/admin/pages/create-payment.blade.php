@extends('admin.base')

@section('content')

    <div class="container-fluid">

        {{-- ================= HEADER ================= --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1">
                    Add Payment
                </h4>

                <p class="text-muted mb-0">
                    {{ $invoice->invoice_number }}
                </p>
            </div>

            <a href="{{ route('clients.show', $client) }}" class="btn btn-light">
                Back to Client
            </a>

        </div>


        {{-- ================= INVOICE SUMMARY ================= --}}
        <div class="row g-3 mb-4">

            {{-- Invoice Total --}}
            <div class="col-md-4">

                <div class="card h-100">

                    <div class="card-body">

                        <small class="text-muted">
                            Invoice Total
                        </small>

                        <h4 class="mb-0 mt-1">
                            {{ number_format($invoice->total, 2) }}
                        </h4>

                    </div>

                </div>

            </div>


            {{-- Paid --}}
            <div class="col-md-4">

                <div class="card h-100">

                    <div class="card-body">

                        <small class="text-muted">
                            Paid
                        </small>

                        <h4 class="text-success mb-0 mt-1">
                            {{ number_format($paid, 2) }}
                        </h4>

                    </div>

                </div>

            </div>


            {{-- Due --}}
            <div class="col-md-4">

                <div class="card h-100">

                    <div class="card-body">

                        <small class="text-muted">
                            Due
                        </small>

                        <h4 class="text-danger mb-0 mt-1">
                            {{ number_format($due, 2) }}
                        </h4>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================= PAYMENT FORM ================= --}}
        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">
                    Payment Information
                </h5>

            </div>


            <div class="card-body">

                {{-- ================= ERRORS ================= --}}
                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('clients.storePayment', [
                        'client' => $client,
                        'invoice' => $invoice,
                    ]) }}"
                    method="POST">

                    @csrf


                    <div class="row g-3">


                        {{-- ================= PAYMENT AMOUNT ================= --}}
                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Payment Amount
                            </label>

                            <input
                                type="number"
                                name="amount"
                                id="paymentAmount"
                                class="form-control"
                                step="0.01"
                                min="0.01"
                                max="{{ $due }}"
                                value="{{ old('amount') }}"
                                placeholder="Enter payment amount"
                                required
                            >

                            <small class="text-muted">

                                Maximum payment:
                                {{ number_format($due, 2) }}

                            </small>

                        </div>


                        {{-- ================= PAYMENT METHOD ================= --}}
                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Payment Method
                            </label>

                            <select
                                name="payment_method"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select Method
                                </option>

                                <option
                                    value="cash"
                                    @selected(old('payment_method') === 'cash')
                                >
                                    Cash
                                </option>

                                <option
                                    value="bank"
                                    @selected(old('payment_method') === 'bank')
                                >
                                    Bank
                                </option>

                                <option
                                    value="card"
                                    @selected(old('payment_method') === 'card')
                                >
                                    Card
                                </option>

                                <option
                                    value="mobile_banking"
                                    @selected(old('payment_method') === 'mobile_banking')
                                >
                                    Mobile Banking
                                </option>

                                <option
                                    value="other"
                                    @selected(old('payment_method') === 'other')
                                >
                                    Other
                                </option>

                            </select>

                        </div>


                        {{-- ================================================= --}}
                        {{-- PAYMENT ALLOCATION --}}
                        {{-- ================================================= --}}
                        <div class="col-12 mt-4">

                            <div class="card border">

                                <div class="card-header">

                                    <h6 class="mb-0">
                                        Payment Allocation
                                    </h6>

                                    <small class="text-muted">
                                        Select which service or visa this payment belongs to.
                                    </small>

                                </div>


                                <div class="card-body">


                                    {{-- ================= ALLOCATION TYPE ================= --}}
                                    <div class="form-check mb-3">

                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="allocation_type"
                                            id="item_level"
                                            value="items"
                                            checked
                                        >

                                        <label
                                            class="form-check-label fw-bold"
                                            for="item_level"
                                        >
                                            Allocate to Services / Visas
                                        </label>

                                    </div>


                                    {{-- ================= ITEMS ================= --}}
                                    <div id="allocationItems">

                                        <div class="table-responsive">

                                            <table class="table table-bordered align-middle">

                                                <thead class="table-light">

                                                    <tr>

                                                        <th>
                                                            Service / Visa
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

                                                        <th
                                                            class="text-end"
                                                            style="width: 180px;"
                                                        >
                                                            Allocate
                                                        </th>

                                                    </tr>

                                                </thead>


                                                <tbody>

                                                    @foreach ($invoice->items as $item)

                                                        @php

                                                            /*
                                                            |--------------------------------------------------------------------------
                                                            | Already Paid For This Item
                                                            |--------------------------------------------------------------------------
                                                            */

                                                            $itemPaid = $item->paymentAllocations
                                                                ->sum('amount');


                                                            /*
                                                            |--------------------------------------------------------------------------
                                                            | Current Due
                                                            |--------------------------------------------------------------------------
                                                            */

                                                            $itemDue = max(
                                                                0,
                                                                (float) $item->total - (float) $itemPaid
                                                            );

                                                        @endphp


                                                        <tr>

                                                            {{-- ================= SERVICE / VISA ================= --}}
                                                            <td>

                                                                <strong>
                                                                    {{ $item->description }}
                                                                </strong>


                                                                @if ($item->service)

                                                                    <small class="d-block text-muted">

                                                                        Service:
                                                                        {{ $item->service->name }}

                                                                    </small>

                                                                @endif


                                                                @if ($item->visa)

                                                                    <small class="d-block text-muted">

                                                                        Visa:
                                                                        {{ $item->visa->country }}

                                                                        @if ($item->visa->visaType)

                                                                            -
                                                                            {{ $item->visa->visaType->name }}

                                                                        @endif

                                                                    </small>

                                                                @endif

                                                            </td>


                                                            {{-- ================= TOTAL ================= --}}
                                                            <td class="text-end">

                                                                {{ number_format($item->total, 2) }}

                                                            </td>


                                                            {{-- ================= PAID ================= --}}
                                                            <td class="text-end text-success">

                                                                {{ number_format($itemPaid, 2) }}

                                                            </td>


                                                            {{-- ================= DUE ================= --}}
                                                            <td class="text-end text-danger fw-semibold">

                                                                {{ number_format($itemDue, 2) }}

                                                            </td>


                                                            {{-- ================= ALLOCATION INPUT ================= --}}
                                                            <td>

                                                                @if ($itemDue > 0)

                                                                    <input
                                                                        type="number"
                                                                        name="allocations[{{ $item->id }}]"
                                                                        class="form-control allocation-input"
                                                                        step="0.01"
                                                                        min="0"
                                                                        max="{{ $itemDue }}"
                                                                        value="{{ old('allocations.' . $item->id, 0) }}"
                                                                        placeholder="0.00"
                                                                        data-due="{{ $itemDue }}"
                                                                    >

                                                                @else

                                                                    <input
                                                                        type="number"
                                                                        class="form-control"
                                                                        value="0.00"
                                                                        disabled
                                                                    >

                                                                @endif

                                                            </td>

                                                        </tr>

                                                    @endforeach

                                                </tbody>


                                                {{-- ================= FOOTER ================= --}}
                                                <tfoot>

                                                    <tr class="fw-bold">

                                                        <td
                                                            colspan="4"
                                                            class="text-end"
                                                        >
                                                            Allocation Total
                                                        </td>

                                                        <td class="text-end">

                                                            <span id="allocationTotal">
                                                                0.00
                                                            </span>

                                                        </td>

                                                    </tr>

                                                </tfoot>

                                            </table>

                                        </div>


                                        {{-- ================= STATUS ================= --}}
                                        <div
                                            id="allocationStatus"
                                            class="alert alert-secondary"
                                        >

                                            Enter the payment amount and allocate it to one or more items.

                                        </div>


                                        {{-- ================= ERROR ================= --}}
                                        <div
                                            id="allocationError"
                                            class="alert alert-danger d-none"
                                        >

                                            Allocation total must match the payment amount.

                                        </div>


                                        {{-- ================= SUCCESS ================= --}}
                                        <div
                                            id="allocationSuccess"
                                            class="alert alert-success d-none"
                                        >

                                            Allocation is correct.

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ================= PAYMENT DATE ================= --}}
                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Payment Date
                            </label>

                            <input
                                type="date"
                                name="payment_date"
                                class="form-control"
                                value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                                required
                            >

                        </div>


                        {{-- ================= TRANSACTION ID ================= --}}
                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Transaction ID
                            </label>

                            <input
                                type="text"
                                name="transaction_id"
                                class="form-control"
                                value="{{ old('transaction_id') }}"
                                placeholder="Optional"
                            >

                        </div>


                        {{-- ================= REFERENCE ================= --}}
                        <div class="col-md-6">

                            <label class="form-label fw-bold">
                                Reference
                            </label>

                            <input
                                type="text"
                                name="reference"
                                class="form-control"
                                value="{{ old('reference') }}"
                                placeholder="Optional"
                            >

                        </div>


                        {{-- ================= NOTES ================= --}}
                        <div class="col-12">

                            <label class="form-label fw-bold">
                                Notes
                            </label>

                            <textarea
                                name="notes"
                                class="form-control"
                                rows="4"
                                placeholder="Payment related notes"
                            >{{ old('notes') }}</textarea>

                        </div>

                    </div>


                    {{-- ================= BUTTONS ================= --}}
                    <div class="d-flex gap-2 mt-4">

                        <a
                            href="{{ route('clients.show', $client) }}"
                            class="btn btn-secondary px-4"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="btn btn-success px-4"
                            id="savePaymentBtn"
                            disabled
                        >
                            Save Payment
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================ --}}
    {{-- JAVASCRIPT --}}
    {{-- ============================================================ --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Elements
            |--------------------------------------------------------------------------
            */

            const amountInput =
                document.getElementById('paymentAmount');

            const allocationInputs =
                document.querySelectorAll('.allocation-input');

            const allocationTotal =
                document.getElementById('allocationTotal');

            const allocationError =
                document.getElementById('allocationError');

            const allocationSuccess =
                document.getElementById('allocationSuccess');

            const allocationStatus =
                document.getElementById('allocationStatus');

            const savePaymentBtn =
                document.getElementById('savePaymentBtn');


            /*
            |--------------------------------------------------------------------------
            | Update Allocation
            |--------------------------------------------------------------------------
            */

            function updateAllocation() {

                let total = 0;


                /*
                |--------------------------------------------------------------------------
                | Calculate Allocation Total
                |--------------------------------------------------------------------------
                */

                allocationInputs.forEach(function (input) {

                    const value =
                        parseFloat(input.value) || 0;

                    total += value;

                });


                /*
                |--------------------------------------------------------------------------
                | Payment Amount
                |--------------------------------------------------------------------------
                */

                const paymentAmount =
                    parseFloat(amountInput.value) || 0;


                /*
                |--------------------------------------------------------------------------
                | Display Total
                |--------------------------------------------------------------------------
                */

                allocationTotal.textContent =
                    total.toFixed(2);


                /*
                |--------------------------------------------------------------------------
                | Payment Amount Empty
                |--------------------------------------------------------------------------
                */

                if (paymentAmount <= 0) {

                    allocationError.classList.add('d-none');

                    allocationSuccess.classList.add('d-none');

                    allocationStatus.classList.remove('d-none');

                    allocationStatus.textContent =
                        'Enter the payment amount and allocate it to one or more items.';

                    savePaymentBtn.disabled = true;

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Allocation Doesn't Match
                |--------------------------------------------------------------------------
                */

                if (
                    Math.abs(total - paymentAmount) > 0.01
                ) {

                    allocationError.classList.remove('d-none');

                    allocationSuccess.classList.add('d-none');

                    allocationStatus.classList.add('d-none');

                    savePaymentBtn.disabled = true;

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Allocation Correct
                |--------------------------------------------------------------------------
                */

                allocationError.classList.add('d-none');

                allocationStatus.classList.add('d-none');

                allocationSuccess.classList.remove('d-none');

                allocationSuccess.textContent =
                    'Allocation is correct. You can save the payment.';

                savePaymentBtn.disabled = false;

            }


            /*
            |--------------------------------------------------------------------------
            | Allocation Input
            |--------------------------------------------------------------------------
            */

            allocationInputs.forEach(function (input) {

                input.addEventListener('input', function () {

                    const due =
                        parseFloat(input.dataset.due) || 0;

                    let value =
                        parseFloat(input.value) || 0;


                    /*
                    |--------------------------------------------------------------------------
                    | Prevent Negative
                    |--------------------------------------------------------------------------
                    */

                    if (value < 0) {

                        input.value = 0;

                        value = 0;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Prevent Item Overpayment
                    |--------------------------------------------------------------------------
                    */

                    if (value > due) {

                        input.value = due;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Update Total
                    |--------------------------------------------------------------------------
                    */

                    updateAllocation();

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Payment Amount Change
            |--------------------------------------------------------------------------
            */

            amountInput.addEventListener(
                'input',
                updateAllocation
            );


            /*
            |--------------------------------------------------------------------------
            | Initial State
            |--------------------------------------------------------------------------
            */

            updateAllocation();

        });

    </script>

@endsection