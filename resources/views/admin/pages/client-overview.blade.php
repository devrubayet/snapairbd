@extends('admin.base')
@section('title', $site_infos->sitename . ' | Client Overview')

@section('content')

    <div class="page-header">
        <h3 class="page-title">Client Full Overview</h3>
    </div>

    {{-- Client Basic Info --}}
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Client Information</h4>

            <div class="row mt-3">
                <div class="col-md-4">
                    <p><strong>Name:</strong> {{ $client->name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Passport Number:</strong> {{ $client->passport_number }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Phone:</strong> {{ $client->phone }}</p>
                </div>
            </div>
        </div>
    </div>


    {{-- Visa + Payment Overview --}}
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Visa & Payment Details</h4>

            @foreach ($client->visas as $visa)
                <div class="border rounded p-3 mb-4">

                    {{-- Visa Info --}}
                    <div class="row justify-content-between">
                        <h5 class="text-primary">Visa: {{ $visa->name }} </h5>
                        <a href="{{ route('invoice.create', $visa->id) }}" class="btn btn-primary btn-sm text-end">
                            Create Invoice
                        </a>
                    </div>


                    <div class="row mt-2">
                        <div class="col-md-4">
                            <p><strong>Applicant Name:</strong> {{ $visa->applicant_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Status:</strong> {{ $visa->status }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Reference:</strong> {{ $visa->reference_number }}</p>
                        </div>
                    </div>

                    {{-- PDF --}}
                    @if ($visa->pdf)
                        <p>
                            <strong>PDF:</strong>
                            <a href="{{ asset('storage/visa_pdfs/' . $visa->pdf) }}" class="btn btn-info btn-sm"
                                target="_blank">View PDF</a>
                        </p>
                    @endif

                    <hr>

                    {{-- Payment --}}
                    <h6 class="text-success">Payment Information</h6>

                    @if ($visa->payments)
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <p><strong>Gross (Client Paid):</strong> {{ $visa->payments->gross_amount ?? '' }} ৳</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Net (Our Cost):</strong> {{ $visa->payments->net_amount ?? '' }} ৳</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Profit:</strong> {{ $visa->payments->profit_amount ?? '' }} ৳</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Note:</strong> {{ $visa->payments->note ?? 'N/A' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-danger">No payment recorded for this visa!</p>
                    @endif

                </div>
            @endforeach

        </div>
    </div>

@endsection
