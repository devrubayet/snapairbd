@extends('admin.base')
@section('title',$settings->site_name .' | '. 'All Airlines List')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> All Airlines List </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Airlines List</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Airlines</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Airlines List</h4>
                    <p class="card-description"> You can <code>Edit or Delete</code> your airlines items here.
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Airlines Name</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($airlines as $airline)
                                    <tr>
                                        <td class=" w-25 h-100">
                                            <img class=" w-100 h-100 rounded-0" src="{{ $airline->image_url }}"
                                                alt="" srcset="">
                                        </td>
                                        <td class="text-capitalize">{{ $airline->name }}</td>


                                        <td><a href="{{ route('edit-airline', $airline->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form class="delete-form" action="{{ route('delete-airline', $airline->id) }}"
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
@endsection
