@extends('admin.base')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Add Service</h4>

            <p class="text-muted mb-0">
                Add a service for {{ $client->name }}
            </p>
        </div>

        <a
            href="{{ route('clients.show', $client) }}"
            class="btn btn-light"
        >
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


    {{-- Service Form --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">
                Service Information
            </h5>
        </div>

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('clients.storeService', $client) }}"
                method="POST"
            >

                @csrf

                <div class="row g-3">

                    {{-- Service --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Service <span class="text-danger">*</span>
                        </label>

                        <select
                            name="service_id"
                            id="service_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Service
                            </option>

                            @foreach ($services as $service)

                                <option
                                    value="{{ $service->id }}"
                                    data-price="{{ $service->default_price }}"
                                    @selected(old('service_id') == $service->id)
                                >
                                    {{ $service->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Related Visa --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Related Visa
                        </label>

                        <select
                            name="visa_id"
                            class="form-select"
                        >

                            <option value="">
                                Not related to a specific visa
                            </option>

                            @foreach ($visas as $visa)

                                <option
                                    value="{{ $visa->id }}"
                                    @selected(old('visa_id') == $visa->id)
                                >
                                    {{ $visa->country }}
                                    -
                                    {{ $visa->visaType?->name ?? 'Visa' }}
                                    -
                                    {{ $visa->visaStatus?->name ?? 'No Status' }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Price --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Price <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="price"
                            id="price"
                            class="form-control"
                            value="{{ old('price') }}"
                            placeholder="Enter price"
                            required
                        >

                        <small class="text-muted">
                            Default service price will be filled automatically.
                        </small>

                    </div>


                    {{-- Quantity --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Quantity <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            min="1"
                            name="quantity"
                            class="form-control"
                            value="{{ old('quantity', 1) }}"
                            required
                        >

                    </div>


                    {{-- Service Date --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Service Date
                        </label>

                        <input
                            type="date"
                            name="service_date"
                            class="form-control"
                            value="{{ old('service_date') }}"
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
                            placeholder="Service related notes"
                        >{{ old('notes') }}</textarea>

                    </div>

                </div>


                {{-- Actions --}}
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
                        Save Service
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- Auto fill default price --}}
<script>

    const serviceSelect = document.getElementById('service_id');
    const priceInput = document.getElementById('price');

    serviceSelect.addEventListener('change', function () {

        const selectedOption =
            this.options[this.selectedIndex];

        const defaultPrice =
            selectedOption.getAttribute('data-price');

        if (defaultPrice && !priceInput.value) {
            priceInput.value = defaultPrice;
        }

    });

</script>

@endsection