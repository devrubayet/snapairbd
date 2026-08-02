<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ $logoPath }}" width="150" alt="Logo">
    </div>

    <h2>Invoice: {{ $invoice->invoice_number }}</h2>

    <p><strong>Client:</strong> {{ $invoice->client->name }} ({{ $invoice->client->passport_number }})</p>
    <p><strong>Visa:</strong> {{ $invoice->visa->name }}</p>

    <p><strong>Issued Date:</strong> 
        {{ $invoice->issued_date ? $invoice->issued_date->format('d M Y') : 'N/A' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Visa Payment (Gross)</td>
                <td class="text-right">{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th class="text-right">{{ number_format($invoice->total_amount, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <p><strong>Note:</strong> {{ $invoice->note }}</p>

</body>
</html>
