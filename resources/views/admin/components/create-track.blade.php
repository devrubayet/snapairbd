@extends('admin.base')

@section('title', $site_infos->sitename .' | '. (isset($visa_status) ? 'Edit Visa' : 'Add Visa'))

@section('content')

<div class="page-header">
    <h3 class="page-title">{{ isset($visa_status) ? 'Edit Visa' : 'Add Visa' }}</h3>
</div>

<div class="card">
    <div class="card-body">

        <h4 class="card-title">{{ isset($visa_status) ? 'Edit Visa Information' : 'Add Visa Information' }}</h4>

        <form class="forms-sample"
              action="{{ isset($visa_status) ? route('visa-update', $visa_status->id) : route('visa-store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @isset($visa_status)
                @method('PUT')
            @endisset


            {{-- Passport Select --}}
            <div class="form-group">
                <label for="passport_number">Select Passport Number</label>
                <select name="passport_number" id="passport_number" class="form-control" required>
                    <option value="">Select Passport</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->passport_number }}"
                            {{ old('passport_number', $visa_status->client->passport_number ?? '') == $client->passport_number ? 'selected' : '' }}>
                            {{ $client->passport_number }} — {{ $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Visa Name --}}
            <div class="form-group">
                <label for="visa_name">Visa Name</label>
                <input type="text" class="form-control" name="visa_name" id="visa_name"
                       placeholder="Visa Name"
                       value="{{ old('visa_name', $visa_status->name ?? '') }}" required>
            </div>


            {{-- Status --}}
            <div class="form-group">
                <label for="status">Visa Status</label>
                <select name="status" class="form-control" id="status" required>
                    @foreach(['Received','Pending','Approved','Rejected'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $visa_status->status ?? '') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Reference Number (Only For Edit) --}}
            @isset($visa_status)
            <div class="form-group">
                <label for="reference_number">Reference Number</label>
                <input type="text" class="form-control" id="reference_number"
                       value="{{ $visa_status->reference_number }}" disabled>
            </div>
            @endisset


            {{-- Payment Section --}}
            <div class="row">
                <div class="col-md-4">
                    <label>Gross Amount (Client Paid)</label>
                    <input type="number" step="0.01" name="gross_amount" id="gross"
                           class="form-control"
                           value="{{ old('gross_amount', $visa_status->gross_amount ?? '') }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label>Net Amount (Our Cost)</label>
                    <input type="number" step="0.01" name="net_amount" id="net"
                           class="form-control"
                           value="{{ old('net_amount', $visa_status->net_amount ?? '') }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label>Profit Amount (Auto Calculated)</label>
                    <input type="number" step="0.01" id="profit"
                           class="form-control"
                           value="{{ old('profit_amount', $visa_status->profit_amount ?? '') }}"
                           readonly>
                </div>
            </div>


            {{-- PDF Upload --}}
            <div class="form-group mt-3">
                <label>PDF File</label>
                <input type="file" name="pdf" class="file-upload-default" accept=".pdf">

                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info"
                           disabled placeholder="Upload PDF"
                           value="{{ isset($visa_status) && $visa_status->pdf ? basename($visa_status->pdf) : '' }}">
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                </div>

                @isset($visa_status->pdf)
                    <div class="mt-2">
                        <a href="{{ asset('storage/visa_pdfs/'. $visa_status->pdf) }}"
                           class="btn btn-info btn-sm" target="_blank">
                            View Existing PDF
                        </a>

                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" name="remove_pdf" value="1" id="remove_pdf">
                            <label for="remove_pdf" class="form-check-label">Remove Existing PDF</label>
                        </div>
                    </div>
                @endisset
            </div>


            <button type="submit" class="btn btn-primary mr-2">
                {{ isset($visa_status) ? 'Update' : 'Submit' }}
            </button>

            <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
        </form>
    </div>
</div>


{{-- Scripts --}}
<script>
    // File Upload
    const fileInput = document.querySelector('.file-upload-default');
    const browseBtn = document.querySelector('.file-upload-browse');
    const fileInfo = document.querySelector('.file-upload-info');

    browseBtn.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileInfo.value = fileInput.files[0].name;
        }
    });

    // Profit Auto Calculation
    const gross = document.getElementById('gross');
    const net = document.getElementById('net');
    const profit = document.getElementById('profit');

    function calculateProfit() {
        let g = parseFloat(gross.value) || 0;
        let n = parseFloat(net.value) || 0;
        profit.value = (g - n).toFixed(2);
    }

    gross.addEventListener('input', calculateProfit);
    net.addEventListener('input', calculateProfit);
</script>

@endsection
