@extends('admin.base')
@section('content')
<div class="page-header">
    <h3 class="page-title">Invoice List</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoices</li>
        </ol>
    </nav>
</div>


<div class="card">
    <div class="card-body">
        <h4 class="card-title">All Invoices</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Invoice #</th>
                        <th>Reference Number</th>
                        <th>Client Name</th>
                        <th>Passport Number</th>
                        <th>Visa Name</th>
                        <th>Status</th>
                        <th>Gross Amount</th>
                        <th>Net Amount</th>
                        <th>Profit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->visa->reference_number ?? '-' }}</td>
                            <td>{{ $invoice->client->name ?? '-' }}</td>
                            <td>{{ $invoice->client->passport_number ?? '-' }}</td>
                            <td>{{ $invoice->visa->name ?? '-' }}</td>
                            <td>
                                <div class="badge bg-{{ 
                                    $invoice->visa->status == 'Approved' ? 'success' : 
                                    ($invoice->visa->status == 'Pending' ? 'warning' : 'danger') 
                                }}">
                                    {{ $invoice->visa->status ?? '-' }}
                                </div>
                            </td>
                            <td>{{ $invoice->total_amount }}</td>
                            <td>{{ $invoice->net_amount }}</td>
                            <td>{{ $invoice->profit_amount }}</td>
                            <td>
                                <a href="{{ route('invoice.show', $invoice->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('invoice.download', $invoice->id) }}" class="btn btn-sm btn-success">Download PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $invoices->links() }}
        </div>
    </div>
</div>


@endsection