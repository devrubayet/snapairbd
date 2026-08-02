@extends('admin.base')
@section('title', $settings->site_name . ' | ' . 'Our Service Sliders List')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Our Service Sliders List </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Our Service Slider</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Slider</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Our Service Sliders List</h4>
                    <p class="card-description"> You can your slider <code>Edit or Delete</code> here.
                    </p>
                    <a class="nav-link" href="{{ route('service-create') }}">
                            <span class="menu-icon"><i class="mdi mdi-library-plus"></i></span>
                            Add Slider</a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td class=" w-25 h-100">
                                            <img class=" w-100 h-100 rounded-0" src="{{ asset('storage/' . $slider->img) }}"
                                                alt="" srcset="">
                                        </td>
                                        <td class="text-capitalize">{{ $slider->title }}</td>

                                        <td>
                                            <form action="{{ route('services-toggle', $slider->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-sm {{ $slider->status == 'active' ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ ucfirst($slider->status) }}
                                                </button>
                                            </form>
                                        </td>
                                        <td><a href="{{ route('services-edit', $slider->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form class="delete-form" action="{{ route('services-destroy', $slider->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // form submit হবে
                    }
                });
            });
        });
    </script>
@endsection
