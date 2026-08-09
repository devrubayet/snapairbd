@extends('admin.base')

@section('content')

<div class="container-fluid">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Add Visa</h4>

            <p class="text-muted mb-0">
                Add a new visa for {{ $client->name }}
            </p>
        </div>

        <a
            href="{{ route('clients.show', $client) }}"
            class="btn btn-light"
        >
            Back to Client
        </a>

    </div>


    {{-- ================= CLIENT INFO ================= --}}
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


    {{-- ================= VISA FORM ================= --}}
    <div class="card">

        <div class="card-header">

            <h5 class="mb-0">
                Visa Information
            </h5>

        </div>


        <div class="card-body">

            {{-- Validation Errors --}}
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
                action="{{ route('clients.storeVisa', $client) }}"
                method="POST"
            >

                @csrf


                <div class="row g-3">

                    {{-- Visa Country --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Visa Country <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="country"
                            class="form-control"
                            value="{{ old('country') }}"
                            placeholder="Enter visa country"
                            required
                        >

                    </div>


                    {{-- Visa Type --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Visa Type <span class="text-danger">*</span>
                        </label>

                        <select
                            name="visa_type_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Visa Type
                            </option>

                            @foreach ($visaTypes as $visaType)

                                <option
                                    value="{{ $visaType->id }}"
                                    @selected(old('visa_type_id') == $visaType->id)
                                >
                                    {{ $visaType->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Visa Status --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Visa Status <span class="text-danger">*</span>
                        </label>

                        <select
                            name="visa_status_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Status
                            </option>

                            @foreach ($visaStatuses as $visaStatus)

                                <option
                                    value="{{ $visaStatus->id }}"
                                    @selected(old('visa_status_id') == $visaStatus->id)
                                >
                                    {{ $visaStatus->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Application Number --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Application Number
                        </label>

                        <input
                            type="text"
                            name="application_no"
                            class="form-control"
                            value="{{ old('application_no') }}"
                            placeholder="Enter application number"
                        >

                    </div>


                    {{-- Application Date --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Application Date
                        </label>

                        <input
                            type="date"
                            name="application_date"
                            class="form-control"
                            value="{{ old('application_date') }}"
                        >

                    </div>


                    {{-- Submission Date --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Submission Date
                        </label>

                        <input
                            type="date"
                            name="submission_date"
                            class="form-control"
                            value="{{ old('submission_date') }}"
                        >

                    </div>


                    {{-- Approval Date --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Approval Date
                        </label>

                        <input
                            type="date"
                            name="approval_date"
                            class="form-control"
                            value="{{ old('approval_date') }}"
                        >

                    </div>


                    {{-- Expiry Date --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Visa Expiry Date
                        </label>

                        <input
                            type="date"
                            name="expiry_date"
                            class="form-control"
                            value="{{ old('expiry_date') }}"
                        >

                    </div>


                    {{-- Notes --}}
                    <div class="col-12">

                        <label class="form-label fw-bold">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            class="form-control"
                            rows="4"
                            placeholder="Enter visa related notes"
                        >{{ old('notes') }}</textarea>

                    </div>

                </div>


                {{-- ================= ACTIONS ================= --}}
                <div class="d-flex gap-2 mt-4">

                    <a
                        href="{{ route('clients.show', $client) }}"
                        class="btn btn-secondary px-4"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary px-4"
                    >
                        Save Visa
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection