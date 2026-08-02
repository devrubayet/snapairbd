@extends('admin.base')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm p-4 rounded-3">

        <h2 class="mb-3">Client List</h2>
        <p class="fs-5 fw-bold mb-3 text-secondary">All registered clients</p>

        <!-- Search Form -->
        <form id="client-search-form" class="row g-2 mb-3">
            @csrf
            <div class="col-12 col-md-6 position-relative">
                <input type="text" name="search" id="search" class="form-control form-control-lg pe-5"
                    placeholder="Search by name, phone or passport">

                <!-- Clear Button -->
                <span id="clearSearch" 
                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);
                    cursor:pointer; display:none; font-size:18px; color:#999;">&times;</span>
            </div>

            <div class="col-12 col-md-auto">
                <button type="submit" class="btn btn-secondary btn-lg w-100">Search</button>
            </div>

            <div class="col-12 col-md-auto">
                <a href="{{ route('client.create') }}" class="btn btn-primary btn-lg w-100">
                    + Add Client
                </a>
            </div>
        </form>

        <!-- Result -->
        <div id="client-result"></div>
    </div>
</div>

<script>
    const form = document.getElementById("client-search-form");
    const searchInput = document.getElementById("search");
    const clearBtn = document.getElementById("clearSearch");
    const resultDiv = document.getElementById("client-result");

    // Show/hide clear button
    searchInput.addEventListener("input", () => {
        clearBtn.style.display = searchInput.value.length ? "block" : "none";
    });

    clearBtn.addEventListener("click", () => {
        searchInput.value = "";
        clearBtn.style.display = "none";
        searchInput.focus();
        fetchClientData();
    });

    async function fetchClientData(search = '', pageUrl = "{{ route('client.index.ajax') }}") {
        resultDiv.innerHTML = `
            <div class="d-flex justify-content-center align-items-center flex-column" style="height:150px;">
                <div class="spinner-border text-secondary" style="width:4rem; height:4rem;"></div>
                <p class="mt-1 text-muted">Loading clients...</p>
            </div>
        `;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(pageUrl, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ search: search })
            });

            const data = await response.json();

            if (data.success) {

                let rows = '';
                data.data.forEach(client => {
                    rows += `
                        <tr>
                            <td><a href="client/${client.id}/overview">${client.name}</a></td>
                            <td>${client.phone}</td>
                            <td>${client.email ?? "-"}</td>
                            <td>${client.passport_number}</td>
                            <td>${client.address ?? "-"}</td>

                            <td>
                                <a href="client/${client.id}/edit" class="btn btn-sm btn-primary">Edit</a>

                                <form action="/client/${client.id}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                });

                let pagination = '';
                if (data.pagination) {
                    pagination = `
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <button class="btn btn-outline-secondary btn-sm" 
                                ${data.pagination.prev_page_url ? '' : 'disabled'}
                                onclick="fetchClientData('${search}', '${data.pagination.prev_page_url}')">
                                Previous
                            </button>

                            <span>Page ${data.pagination.current_page} of ${data.pagination.last_page}</span>

                            <button class="btn btn-outline-secondary btn-sm"
                                ${data.pagination.next_page_url ? '' : 'disabled'}
                                onclick="fetchClientData('${search}', '${data.pagination.next_page_url}')">
                                Next
                            </button>
                        </div>
                    `;
                }

                resultDiv.innerHTML = `
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Passport</th>
                                    <th>Address</th>
                                    <th style="width:150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>${rows}</tbody>
                        </table>
                    </div>
                    ${pagination}
                `;

            } else {
                resultDiv.innerHTML = `<div class="alert alert-danger mt-3">${data.message}</div>`;
            }

        } catch (err) {
            console.error(err);
            resultDiv.innerHTML = `<div class="alert alert-danger mt-3">Error loading data!</div>`;
        }
    }

    // Form submit
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        fetchClientData(searchInput.value);
    });

    // Auto load all clients on page load
    window.addEventListener("load", () => fetchClientData());
</script>

@endsection
