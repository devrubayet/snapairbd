@extends('admin.base')
@section('title',$settings->site_name .' | '. ( isset($airline) ? 'Edit Airline' : 'Add Airline' ))
@section('content')
<div class="page-header">
    <h3 class="page-title">{{ isset($airline) ? 'Edit Airline' : 'Add Airline' }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{ isset($airline) ? 'Edit Airline' : 'Add Airline' }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ isset($airline) ? 'Edit Airline' : 'Add Airline' }}</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ isset($airline) ? 'Edit airline' : 'Add airline' }}</h4>
        <p class="card-description">{{ isset($airline) ? 'Update the service airline' : 'Add new service airline' }}</p>

        <form class="forms-sample"
              action="{{ isset($airline) ? route('update-airline', $airline->id) : route('store-airline') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @if(isset($airline))
                @method('PUT')
            @endif

            {{-- Title --}}
            <div class="form-group">
                <label for="title">Airline Title</label>
                <input type="text" class="form-control" name="name" id="title"
                       placeholder="airline Title"
                       value="{{ old('title', $airline->name ?? '') }}" required>
            </div>

            

            {{-- Image Upload --}}
            <div class="form-group">
                <label>Image upload</label>
                <input type="file" name="image" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled
                           placeholder="Upload Image" value="{{ $airline->image ?? '' }}">
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                </div>

                {{-- Existing image preview (edit mode) --}}
                @if(isset($airline) && $airline->image)
                    <img src="{{ asset('storage/' . $airline->image) }}" alt="airline"
                         class="img-fluid mt-2" style="max-height:150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary mr-2">{{ isset($airline) ? 'Update' : 'Submit' }}</button>
            <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
        </form>
    </div>
</div>

<script>
    // file upload UI
    document.querySelector('.file-upload-browse').addEventListener('click', function () {
        document.querySelector('.file-upload-default').click();
    });

    document.querySelector('.file-upload-default').addEventListener('change', function () {
        if (this.files.length > 0) {
            document.querySelector('.file-upload-info').value = this.files[0].name;
        }
    });
</script>
@endsection

