@extends('admin.base')

@section('content')

<div class="container-fluid">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Clients</h4>
            <p class="text-muted mb-0">
                Manage all your clients
            </p>
        </div>

        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            + Add New Client
        </a>

    </div>


    {{-- ================= SUCCESS MESSAGE ================= --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

        </div>
    @endif


    {{-- ================= SEARCH ================= --}}
    <div class="card mb-4">

        <div class="card-body">

            <form
                action="{{ route('clients.index') }}"
                method="GET"
            >

                <div class="row g-2">

                    <div class="col-md-10">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ $search ?? '' }}"
                            placeholder="Search by client name, phone, email or passport..."
                        >

                    </div>

                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Search
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ================= CLIENT TABLE ================= --}}
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Client List
            </h5>

            <span class="text-muted">
                {{ $clients->total() }} Clients
            </span>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th style="width: 60px;">
                                #
                            </th>

                            <th>
                                Client
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Passport
                            </th>

                            <th>
                                Visas
                            </th>

                            <th>
                                Created
                            </th>

                            <th class="text-end">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($clients as $index => $client)

                            <tr>

                                {{-- Serial --}}
                                <td>
                                    {{ $clients->firstItem() + $index }}
                                </td>


                                {{-- Client --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $client->name }}
                                    </div>

                                    @if($client->email)
                                        <small class="text-muted">
                                            {{ $client->email }}
                                        </small>
                                    @endif

                                </td>


                                {{-- Phone --}}
                                <td>
                                    {{ $client->phone ?? '-' }}
                                </td>


                                {{-- Passport --}}
                                <td>
                                    {{ $client->passport_no ?? '-' }}
                                </td>


                                {{-- Visa Count --}}
                                <td>

                                    <span class="badge bg-primary">
                                        {{ $client->visas()->count() }}
                                    </span>

                                </td>


                                {{-- Created --}}
                                <td>

                                    {{ $client->created_at?->format('d M Y') }}

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('clients.show', $client) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="View Client"
                                        >
                                            View
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('clients.edit', $client) }}"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Edit Client"
                                        >
                                            Edit
                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('clients.destroy', $client) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this client?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete Client"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        @if($search)
                                            No client found for
                                            <strong>
                                                "{{ $search }}"
                                            </strong>
                                        @else
                                            No clients found.
                                        @endif

                                    </div>


                                    @if($search)

                                        <a
                                            href="{{ route('clients.index') }}"
                                            class="btn btn-sm btn-outline-primary mt-3"
                                        >
                                            Clear Search
                                        </a>

                                    @else

                                        <a
                                            href="{{ route('clients.create') }}"
                                            class="btn btn-sm btn-primary mt-3"
                                        >
                                            + Add First Client
                                        </a>

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ================= PAGINATION ================= --}}
        @if($clients->hasPages())

            <div class="card-footer">

                {{ $clients->links() }}

            </div>

        @endif

    </div>

</div>

@endsection