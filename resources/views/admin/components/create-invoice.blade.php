@extends('admin.base')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1">Create Invoice</h4>

                <p class="text-muted mb-0">
                    Create invoice for {{ $client->name }}
                </p>
            </div>

            <a href="{{ route('clients.show', $client) }}" class="btn btn-light">
                Back to Client
            </a>

        </div>


        {{-- Client Information --}}
        <div class="card mb-4">

            <div class="card-header">
                <h5 class="mb-0">
                    Client Information
                </h5>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Client Name
                        </small>

                        <strong>
                            {{ $client->name }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Phone
                        </small>

                        <strong>
                            {{ $client->phone ?? '-' }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Passport
                        </small>

                        <strong>
                            {{ $client->passport_no ?? '-' }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        {{-- Invoice Form --}}
        <form action="{{ route('clients.storeInvoice', $client) }}" method="POST" id="invoiceForm">

            @csrf


            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif


            {{-- ================= VISA ITEMS ================= --}}
            {{-- ================= BILLABLE SERVICES ================= --}}
            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0">
                            Invoice Items
                        </h5>

                        <small class="text-muted">
                            Select the services you want to include in this invoice.
                        </small>
                    </div>

                    <span class="badge bg-primary">
                        {{ $client->services->count() }} Available
                    </span>

                </div>


                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th width="50">
                                        Select
                                    </th>

                                    <th>
                                        Service
                                    </th>

                                    <th>
                                        Related Visa
                                    </th>

                                    <th>
                                        Quantity
                                    </th>

                                    <th>
                                        Unit Price
                                    </th>

                                    <th>
                                        Total
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($client->services as $clientService)
                                    @php
                                        $lineTotal = $clientService->price * $clientService->quantity;
                                    @endphp

                                    <tr>

                                        {{-- Select --}}
                                        <td>

                                            <input type="checkbox" class="form-check-input invoice-item" name="items[]"
                                                value="service:{{ $clientService->id }}" data-price="{{ $lineTotal }}">

                                        </td>


                                        {{-- Service --}}
                                        <td>

                                            <strong>
                                                {{ $clientService->service?->name ?? '-' }}
                                            </strong>

                                            @if ($clientService->notes)
                                                <small class="text-muted d-block">
                                                    {{ $clientService->notes }}
                                                </small>
                                            @endif

                                        </td>


                                        {{-- Related Visa --}}
                                        <td>

                                            @if ($clientService->visa)
                                                <span class="fw-semibold">

                                                    {{ $clientService->visa->country }}

                                                </span>

                                                @if ($clientService->visa->visaType)
                                                    <small class="text-muted d-block">
                                                        {{ $clientService->visa->visaType->name }}
                                                    </small>
                                                @endif
                                            @else
                                                <span class="text-muted">
                                                    Not linked
                                                </span>
                                            @endif

                                        </td>


                                        {{-- Quantity --}}
                                        <td>

                                            {{ number_format($clientService->quantity, 0) }}

                                        </td>


                                        {{-- Unit Price --}}
                                        <td>

                                            {{ number_format($clientService->price, 2) }}

                                        </td>


                                        {{-- Total --}}
                                        <td>

                                            <strong>
                                                {{ number_format($lineTotal, 2) }}
                                            </strong>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="text-center py-5">

                                            <div class="text-muted mb-3">
                                                No services available for invoice.
                                            </div>

                                            <a href="{{ route('clients.addService', $client) }}"
                                                class="btn btn-sm btn-primary">
                                                + Add Service
                                            </a>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- ================= SERVICE ITEMS ================= --}}
            

            {{-- ================= INVOICE SUMMARY ================= --}}
            <div class="row justify-content-end">

                <div class="col-md-5">

                    <div class="card">

                        <div class="card-header">

                            <h5 class="mb-0">
                                Invoice Summary
                            </h5>

                        </div>


                        <div class="card-body">

                            {{-- Subtotal --}}
                            <div class="d-flex justify-content-between mb-3">

                                <span>
                                    Subtotal
                                </span>

                                <strong id="subtotal">
                                    0.00
                                </strong>

                            </div>


                            {{-- Discount --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Discount
                                </label>

                                <input type="number" name="discount" id="discount" class="form-control"
                                    value="{{ old('discount', 0) }}" min="0" step="0.01">

                            </div>


                            {{-- Tax --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Tax
                                </label>

                                <input type="number" name="tax" id="tax" class="form-control"
                                    value="{{ old('tax', 0) }}" min="0" step="0.01">

                            </div>


                            <hr>


                            {{-- Total --}}
                            <div class="d-flex justify-content-between">

                                <span class="fw-bold">
                                    Total
                                </span>

                                <strong class="fs-5" id="grandTotal">
                                    0.00
                                </strong>

                            </div>


                            {{-- Invoice Date --}}
                            <div class="mt-4">

                                <label class="form-label">
                                    Invoice Date
                                </label>

                                <input type="date" name="invoice_date" class="form-control"
                                    value="{{ old('invoice_date', now()->format('Y-m-d')) }}"
                                    required>

                            </div>


                            {{-- Due Date --}}
                            <div class="mt-3">

                                <label class="form-label">
                                    Due Date
                                </label>

                                <input type="date" name="due_date" class="form-control"
                                    value="{{ old('due_date') }}">

                            </div>


                            {{-- Notes --}}
                            <div class="mt-3">

                                <label class="form-label">
                                    Notes
                                </label>

                                <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>

                            </div>


                            {{-- Submit --}}
                            <button type="submit" class="btn btn-primary w-100 mt-4">
                                Create Invoice
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- ================= CALCULATION SCRIPT ================= --}}
    <script>
        function calculateInvoice() {
            let subtotal = 0;

            document
                .querySelectorAll('.invoice-item:checked')
                .forEach(function(item) {

                    subtotal += parseFloat(
                        item.dataset.price || 0
                    );

                });


            let discount = parseFloat(
                document.getElementById('discount').value || 0
            );

            let tax = parseFloat(
                document.getElementById('tax').value || 0
            );


            let total = subtotal - discount + tax;


            if (total < 0) {
                total = 0;
            }


            document.getElementById('subtotal').innerText =
                subtotal.toFixed(2);

            document.getElementById('grandTotal').innerText =
                total.toFixed(2);
        }


        document
            .querySelectorAll('.invoice-item')
            .forEach(function(checkbox) {

                checkbox.addEventListener(
                    'change',
                    calculateInvoice
                );

            });


        document
            .getElementById('discount')
            .addEventListener(
                'input',
                calculateInvoice
            );


        document
            .getElementById('tax')
            .addEventListener(
                'input',
                calculateInvoice
            );


        calculateInvoice();
    </script>

@endsection
