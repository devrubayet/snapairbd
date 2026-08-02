<div class="container py-5">
    <div class="card shadow-sm p-4 rounded-3">
        <h2 class="mb-3">Visa Tracking</h2>
        <p class="fs-5 fw-bold mb-3 text-secondary">
            Enter your reference number to track your application
        </p>

        <!-- Track Form -->
        <form id="visa-status-form" class="row g-2">
            @csrf
            <div class="col-12 col-md-8 position-relative">
                <input type="text" name="reference_number" class="form-control form-control-lg pe-5"
                    id="reference_number" placeholder="Enter Reference Number">

                <!-- Clear Button -->
                <span id="clearInput"
                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor:pointer; display:none; font-size:18px; color:#999;">
                    &times;
                </span>
            </div>
            <div class="col-12 col-md-auto">
                <button type="submit" class="btn btn-secondary btn-lg w-100">Track</button>
            </div>
        </form>

        <!-- Result Section -->
        <div id="visa-status-result" class="mt-4"></div>
    </div>
</div>

<script>
    const form = document.getElementById('visa-status-form');
    const input = document.getElementById('reference_number');
    const clearBtn = document.getElementById('clearInput');
    const resultDiv = document.getElementById('visa-status-result');

    // Clear button show/hide
    input.addEventListener('input', () => {
        clearBtn.style.display = input.value.length ? 'block' : 'none';
    });

    clearBtn.addEventListener('click', () => {
        input.value = '';
        clearBtn.style.display = 'none';
        input.focus();
    });

    // Fetch visa data
    async function fetchVisaData(referenceNumber = '', pageUrl = "{{ route('visa-status.index') }}") {
        resultDiv.innerHTML = `
        <div class="d-flex justify-content-center align-items-center flex-column" style="height:150px;">
            <div class="spinner-border text-secondary" role="status" style="width:4rem; height:4rem;"></div>
            <p class="mt-1 text-muted fw-normal fs-6">Fetching your application data...</p>
        </div>
    `;

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch(pageUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    reference_number: referenceNumber
                })
            });

            const data = await response.json();

            if (data.success) {
                let rows = '';
                data.data.forEach(item => {
                    rows += `
                    <tr>
                        <td>${item.reference_number}</td>
                        <td>${item.name ?? '-'}</td>
                        <td>${item.applicant_name ?? '-'}</td>
                        <td>
                            <div class="badge bg-${
                                item.status === 'Approved'
                                ? 'success'
                                : (item.status === 'Pending' ? 'warning' : 'danger')
                            }">${item.status}</div>
                        </td>
                        <td>
                            ${item.pdf
                                ? `<a href="/storage/${item.pdf}" target="_blank" class="btn btn-sm btn-info">View PDF</a>`
                                : 'N/A'}
                        </td>
                        <td>
                            <a href="/admin/edit-visa/${item.id}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                                
                            <form class="delete-form" action="/admin/delete-visa/${item.id}"
                                method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-delete">
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
                        <button class="btn btn-outline-secondary btn-sm" ${
                            data.pagination.prev_page_url ? '' : 'disabled'
                        } onclick="fetchVisaData('${referenceNumber}', '${data.pagination.prev_page_url}')">Previous</button>

                        <span>Page ${data.pagination.current_page} of ${data.pagination.last_page}</span>

                        <button class="btn btn-outline-secondary btn-sm" ${
                            data.pagination.next_page_url ? '' : 'disabled'
                        } onclick="fetchVisaData('${referenceNumber}', '${data.pagination.next_page_url}')">Next</button>
                    </div>
                `;
                }

                resultDiv.innerHTML = `
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Reference Number</th>
                                <th>Passport Number</th>
                                <th>Applicant Name</th>
                                <th>Status</th>
                                <th>PDF</th>
                                <th>Action</th>
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
        } catch (error) {
            resultDiv.innerHTML =
                `<div class="alert alert-danger mt-3">Something went wrong! Please try again later.</div>`;
            console.error(error);
        }
    }

    // Handle form submit
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        fetchVisaData(input.value);
    });

    // Page load → show all data by default
    window.addEventListener('load', () => {
        fetchVisaData();
    });
</script>
