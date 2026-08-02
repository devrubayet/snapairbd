@extends('admin.base')
@section('title',$site_infos->sitename .' | '. ( isset($bank) ? 'Edit Bank Detail' : 'Add Bank Detail' ))
@section('content')
<div class="page-header">
    <h3 class="page-title">{{ isset($bank) ? 'Edit Bank Detail' : 'Add Bank Detail' }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{ isset($bank) ? 'Edit Bank' : 'Add Bank' }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ isset($bank) ? 'Edit Bank' : 'Add Bank' }}</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ isset($bank) ? 'Edit Bank Information' : 'Add Bank Information' }}</h4>
        <p class="card-description">
            {{ isset($bank) ? 'Update the bank account details' : 'Add a new bank account for payment' }}
        </p>

        <form class="forms-sample"
              action="{{ isset($bank) ? route('bank.update', $bank->id) : route('bank.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @if(isset($bank))
                @method('PUT')
            @endif

            {{-- Bank Name --}}
            <div class="form-group">
                <label for="bank_name">Bank Name</label>
                <input type="text" class="form-control" name="bank_name" id="bank_name"
                       placeholder="Enter Bank Name"
                       value="{{ old('bank_name', $bank->bank_name ?? '') }}" required>
            </div>

            {{-- Account Name --}}
            <div class="form-group">
                <label for="account_name">Account Holder Name</label>
                <input type="text" class="form-control" name="account_name" id="account_name"
                       placeholder="Enter Account Holder Name"
                       value="{{ old('account_name', $bank->account_name ?? '') }}" required>
            </div>

            {{-- Account Number --}}
            <div class="form-group">
                <label for="account_number">Account Number</label>
                <input type="text" class="form-control" name="account_number" id="account_number"
                       placeholder="Enter Account Number"
                       value="{{ old('account_number', $bank->account_number ?? '') }}" required>
            </div>

            {{-- Branch --}}
            <div class="form-group">
                <label for="branch">Branch Name</label>
                <input type="text" class="form-control" name="branch_name" id="branch"
                       placeholder="Enter Branch Name"
                       value="{{ old('branch_name', $bank->branch_name ?? '') }}">
            </div>

            {{-- Swift Code --}}
            <div class="form-group">
                <label for="swift_code">SWIFT Code (optional)</label>
                <input type="text" class="form-control" name="swift_code" id="swift_code"
                       placeholder="Enter SWIFT Code"
                       value="{{ old('swift_code', $bank->swift_code ?? '') }}">
            </div>

            {{-- Note --}}
            {{-- <div class="form-group">
                <label for="note">Note / Instruction (optional)</label>
                <textarea class="form-control" name="note" id="note" rows="3"
                          placeholder="e.g. Send only from local bank...">{{ old('note', $bank->note ?? '') }}</textarea>
            </div> --}}

            <button type="submit" class="btn btn-primary mr-2">
                {{ isset($bank) ? 'Update' : 'Submit' }}
            </button>
            <a href="" class="btn btn-dark">Cancel</a>
        </form>
    </div>
</div>
@endsection
