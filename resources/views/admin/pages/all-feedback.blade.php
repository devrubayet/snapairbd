@extends('admin.base')
@section('title',$settings->site_name .' | '. 'All Testimonials List')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> All Testimonials List </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Testimonials List</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Testimonials</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Testimonials List</h4>
                    <p class="card-description"> You can <code>Edit or Delete</code> your testimonial items here.</p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Bio</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td class="w-25 h-100">
                                            <img class="w-100 h-100 rounded-circle" src="{{ $testimonial->image_url }}" alt="avatar">
                                        </td>
                                        <td class="text-capitalize">{{ $testimonial->name }}</td>
                                        <td>{{ $testimonial->bio }}</td>
                                        <td>{{ Str::limit($testimonial->message, 50) }}</td>
                                        <td>
                                            <a href="{{ route('edit-testi', $testimonial->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form class="delete-form" action="{{ route('delete-testi', $testimonial->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete">Delete</button>
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
@endsection
