@extends('admin.base')
@section('title',$site_infos->sitename .' | '.'All Bank List')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> All Bank Details </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Bank Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Banks</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Bank Details</h4>
                    <p class="card-description"> You can <code>Edit or Delete</code> your bank items here.</p>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bank Logo</th>
                                    <th>Bank Name</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $bank)
                                    <tr>
                                        <td class="w-25 h-100">
                                            {{-- @if($bank->logo_url)
                                                <img class="w-100 h-100 rounded-0" src="{{ $bank->logo_url }}" alt="Bank Logo">
                                            @else
                                                <span>No Logo</span>
                                            @endif --}}
                                        </td>
                                        <td class="text-capitalize">{{ $bank->bank_name }}</td>
                                        <td>{{ $bank->account_name }}</td>
                                        <td>{{ $bank->account_number }}</td>
                                        <td>
                                            <a href="{{ route('bank.edit', $bank->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form class="delete-form" action="{{ route('bank-destroy', $bank->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($banks->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No bank details found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
