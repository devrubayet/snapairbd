@extends('admin.base')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Add New Client</h4>
        </div>

        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('clients.store') }}" method="POST">
                @csrf

                {{-- ================= CLIENT INFORMATION ================= --}}
                <div class="mb-4">

                    <h5 class="mb-3">Client Information</h5>

                    <div class="row g-3">

                        {{-- Client Name --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Client Name <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter client name"
                                required
                            >
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Phone <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Enter phone number"
                                required
                            >
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter email"
                            >
                        </div>

                        {{-- Passport Number --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Passport Number
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="passport_no"
                                value="{{ old('passport_no') }}"
                                placeholder="Enter passport number"
                            >
                        </div>

                        {{-- Passport Expiry --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Passport Expiry
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                name="passport_expiry"
                                value="{{ old('passport_expiry') }}"
                            >
                        </div>

                        {{-- Date of Birth --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Date of Birth
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                name="date_of_birth"
                                value="{{ old('date_of_birth') }}"
                            >
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Gender
                            </label>

                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="male" @selected(old('gender') === 'male')>
                                    Male
                                </option>
                                <option value="female" @selected(old('gender') === 'female')>
                                    Female
                                </option>
                                <option value="other" @selected(old('gender') === 'other')>
                                    Other
                                </option>
                            </select>
                        </div>

                        {{-- Nationality --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Nationality
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="nationality"
                                value="{{ old('nationality') }}"
                                placeholder="Enter nationality"
                            >
                        </div>

                        {{-- Address --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Address
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="address"
                                value="{{ old('address') }}"
                                placeholder="Enter address"
                            >
                        </div>

                        {{-- City --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                City
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="city"
                                value="{{ old('city') }}"
                                placeholder="Enter city"
                            >
                        </div>

                        {{-- Country --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Country
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="country"
                                value="{{ old('country') }}"
                                placeholder="Enter country"
                            >
                        </div>

                        {{-- Emergency Contact --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Emergency Contact
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="emergency_contact"
                                value="{{ old('emergency_contact') }}"
                                placeholder="Emergency contact name"
                            >
                        </div>

                        {{-- Emergency Phone --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Emergency Phone
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="emergency_phone"
                                value="{{ old('emergency_phone') }}"
                                placeholder="Emergency phone number"
                            >
                        </div>

                        {{-- Notes --}}
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                Notes
                            </label>

                            <textarea
                                class="form-control"
                                name="notes"
                                rows="3"
                                placeholder="Additional notes"
                            >{{ old('notes') }}</textarea>
                        </div>

                    </div>

                </div>


                {{-- ================= VISA APPLICATIONS ================= --}}
                <div class="mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h5 class="mb-0">
                            Visa Applications
                        </h5>

                        <button
                            type="button"
                            class="btn btn-outline-primary btn-sm"
                            id="addVisaBtn"
                        >
                            + Add Another Visa
                        </button>

                    </div>


                    <div id="visaContainer">

                        {{-- First Visa --}}
                        <div class="visa-item border rounded p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h6 class="mb-0 visa-title">
                                    Visa #1
                                </h6>

                            </div>

                            <div class="row g-3">

                                {{-- Country --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Visa Country
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="visas[0][country]"
                                        placeholder="Enter visa country"
                                    >
                                </div>

                                {{-- Visa Type --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Visa Type
                                    </label>

                                    <select
                                        name="visas[0][visa_type_id]"
                                        class="form-select"
                                    >
                                        <option value="">
                                            Select Visa Type
                                        </option>

                                        @foreach ($visaTypes as $visaType)
                                            <option
                                                value="{{ $visaType->id }}"
                                            >
                                                {{ $visaType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Visa Status --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Visa Status
                                    </label>

                                    <select
                                        name="visas[0][visa_status_id]"
                                        class="form-select"
                                    >
                                        <option value="">
                                            Select Status
                                        </option>

                                        @foreach ($visaStatuses as $visaStatus)
                                            <option
                                                value="{{ $visaStatus->id }}"
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
                                        class="form-control"
                                        name="visas[0][application_no]"
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
                                        class="form-control"
                                        name="visas[0][application_date]"
                                    >
                                </div>

                                {{-- Submission Date --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Submission Date
                                    </label>

                                    <input
                                        type="date"
                                        class="form-control"
                                        name="visas[0][submission_date]"
                                    >
                                </div>

                                {{-- Approval Date --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Approval Date
                                    </label>

                                    <input
                                        type="date"
                                        class="form-control"
                                        name="visas[0][approval_date]"
                                    >
                                </div>

                                {{-- Expiry Date --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        Visa Expiry Date
                                    </label>

                                    <input
                                        type="date"
                                        class="form-control"
                                        name="visas[0][expiry_date]"
                                    >
                                </div>

                                {{-- Visa Notes --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold">
                                        Visa Notes
                                    </label>

                                    <textarea
                                        class="form-control"
                                        name="visas[0][notes]"
                                        rows="2"
                                        placeholder="Visa related notes"
                                    ></textarea>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================= ACTIONS ================= --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('clients.index') }}"
                        class="btn btn-secondary px-4"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary px-4"
                    >
                        Save Client
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>


{{-- ================= JAVASCRIPT ================= --}}
<script>

    let visaIndex = 1;

    document.getElementById('addVisaBtn').addEventListener('click', function () {

        const container = document.getElementById('visaContainer');

        const visaHtml = `
            <div class="visa-item border rounded p-3 mb-3">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h6 class="mb-0 visa-title">
                        Visa #${visaIndex + 1}
                    </h6>

                    <button
                        type="button"
                        class="btn btn-outline-danger btn-sm removeVisaBtn"
                    >
                        Remove
                    </button>

                </div>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Visa Country
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="visas[${visaIndex}][country]"
                            placeholder="Enter visa country"
                        >
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Visa Type
                        </label>

                        <select
                            name="visas[${visaIndex}][visa_type_id]"
                            class="form-select"
                        >
                            <option value="">
                                Select Visa Type
                            </option>

                            @foreach ($visaTypes as $visaType)
                                <option value="{{ $visaType->id }}">
                                    {{ $visaType->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Visa Status
                        </label>

                        <select
                            name="visas[${visaIndex}][visa_status_id]"
                            class="form-select"
                        >
                            <option value="">
                                Select Status
                            </option>

                            @foreach ($visaStatuses as $visaStatus)
                                <option value="{{ $visaStatus->id }}">
                                    {{ $visaStatus->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Application Number
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="visas[${visaIndex}][application_no]"
                            placeholder="Enter application number"
                        >
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Application Date
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="visas[${visaIndex}][application_date]"
                        >
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Submission Date
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="visas[${visaIndex}][submission_date]"
                        >
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Approval Date
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="visas[${visaIndex}][approval_date]"
                        >
                    </div>


                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Visa Expiry Date
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="visas[${visaIndex}][expiry_date]"
                        >
                    </div>


                    <div class="col-12">
                        <label class="form-label fw-bold">
                            Visa Notes
                        </label>

                        <textarea
                            class="form-control"
                            name="visas[${visaIndex}][notes]"
                            rows="2"
                            placeholder="Visa related notes"
                        ></textarea>
                    </div>

                </div>

            </div>
        `;

        container.insertAdjacentHTML('beforeend', visaHtml);

        visaIndex++;
    });


    document.addEventListener('click', function (event) {

        if (event.target.classList.contains('removeVisaBtn')) {

            event.target.closest('.visa-item').remove();

            updateVisaTitles();
        }

    });


    function updateVisaTitles() {

        const visaItems = document.querySelectorAll('.visa-item');

        visaItems.forEach((item, index) => {

            const title = item.querySelector('.visa-title');

            title.textContent = `Visa #${index + 1}`;

        });

    }

</script>

@endsection