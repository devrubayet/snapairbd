@extends('admin.base')
@section('title',$settings->site_name .' | '.  (isset($testimonial) ? 'Edit Feedback' : 'Add Feedback'))
@section('content')

<div class="page-header">
    <h3 class="page-title">{{ isset($testimonial) ? 'Edit Feedback' : 'Add Feedback' }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Feedback</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ isset($testimonial) ? 'Edit Feedback' : 'Add Feedback' }}</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ isset($testimonial) ? 'Edit testimonial' : 'Add Feedback' }}</h4>
        <p class="card-description">{{ isset($testimonial) ? 'Update the feedback details' : 'Add new feedback' }}</p>

        <form class="forms-sample"
              action="{{ isset($testimonial) ? route('update-testi', $testimonial->id) : route('store-testi') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @if(isset($testimonial))
                @method('PUT')
            @endif

            {{-- Name --}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name"
                       placeholder="Enter Name"
                       value="{{ old('name', $testimonial->name ?? '') }}" required>
            </div>

            {{-- Avatar --}}
            <div class="form-group">
                <label>Avatar</label>
                <input type="file" name="avatar" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled
                           placeholder="Upload Avatar" value="{{ $testimonial->avatar ?? '' }}">
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                </div>

                {{-- Existing avatar preview --}}
                @if(isset($testimonial) && $testimonial->avatar)
                    <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="avatar"
                         class="img-fluid mt-2" style="max-height:150px;">
                @endif
            </div>

            {{-- Bio --}}
            <div class="form-group">
                <label for="bio">Bio</label>
                <input type="text" class="form-control" name="bio" id="bio"
                       placeholder="Enter Bio"
                       value="{{ old('bio', $testimonial->bio ?? '') }}">
            </div>

            {{-- Message --}}
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4"
                          placeholder="Enter Message">{{ old('message', $testimonial->message ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mr-2">{{ isset($testimonial) ? 'Update' : 'Submit' }}</button>
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
