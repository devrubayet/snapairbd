@extends('admin.base')
@section('title', 'Create Invoice')
@section('content')

<h4>Generate Invoice for Visa: {{ $invoice->visa->name }}</h4>

<div class="card mb-4">
    <div class="card-body">
        <h5>Client Details</h5>
        <p>Name: {{ $invoice->visa->client->name }}</p>
        <p>Passport: {{ $invoice->visa->client->passport_number }}</p>
        <p>Phone: {{ $invoice->visa->client->phone }}</p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5>Visa Details</h5>
        <p>Visa Name: {{ $invoice->visa->name }}</p>
        <p>Reference Number: {{ $invoice->visa->reference_number }}</p>
        <p>Status: {{ $invoice->visa->status }}</p>
        <p>
            PDF: 
            @if($invoice->visa->pdf)
                <a href="{{ asset('storage/visa_pdfs/'.$invoice->visa->pdf) }}" target="_blank">View PDF</a>
            @else
                N/A
            @endif
        </p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5>Payment Details</h5>
        <p>Total Amount: {{ $invoice->payment->gross_amount ?? 0 }}</p>
      
        <p>Note: {{ $invoice->payment->note ?? '-' }}</p>
    </div>
</div>

<form action="{{ route('invoice.store', $invoice->visa->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Invoice Note (optional)</label>
        <textarea name="note" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Generate Invoice</button>
</form>

@endsection
