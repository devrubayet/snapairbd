@extends('admin.base')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm p-4 rounded-3">
        <h2 class="mb-3">Create New Client</h2>
        <p class="text-secondary mb-4">Add a new client’s information</p>

        <form action="{{ route('client.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                
                <!-- Client Name -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Client Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter client name" required>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter phone number" required>
                </div>

                {{-- <!-- Email -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                </div> --}}

                <!-- Passport Number -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Passport Number</label>
                    <input type="text" class="form-control" name="passport_number" placeholder="Enter passport number" required>
                </div>

                {{-- <!-- Date of Birth -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <input type="date" class="form-control" name="dob">
                </div> --}}

                {{-- <!-- Address -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter address">
                </div> --}}

            </div>

            <button type="submit" class="btn btn-primary mt-4 px-4">
                Save Client
            </button>
        </form>
    </div>
</div>
@endsection
