@extends('admin.base')

@section('title', $settings->site_name . ' | ' . (isset($slider) ? 'Edit Slider' : 'Add Slider'))

@section('content')

<div class="page-header">
    <h3 class="page-title">
        {{ isset($slider) ? 'Edit Slider' : 'Add Slider' }}
    </h3>
</div>

<div class="card">
    <div class="card-body">
       

        <form action="{{ isset($slider) ? route('services-update', $slider->id) : route('services-store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @if(isset($slider))
                @method('PUT')
            @endif

            {{-- Title --}}
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $slider->title ?? '') }}" required>
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $slider->description ?? '') }}</textarea>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label>Status</label><br>

                <input type="hidden" name="status" value="inactive">

                <input type="checkbox" name="status" value="active"
                    {{ old('status', $slider->status ?? 'active') == 'active' ? 'checked' : '' }}>
                Active
            </div>

            {{-- Image --}}
            <div class="form-group">
                <label>Upload Image</label>

                <input type="file" name="img" class="form-control">
                @error('img')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                {{-- Preview --}}
                @if(isset($slider) && $slider->img)
                    <img src="{{ asset('storage/' . $slider->img) }}"
                         style="max-height:150px;margin-top:10px;">
                @endif
            </div>

            {{-- Keywords --}}
            {{-- <div class="form-group">
                <label>Keywords</label>
                <input type="text" name="keywords" class="form-control"
                       value="{{ old('keywords', $slider->keywords ?? '') }}">
            </div> --}}

            <button type="submit" class="btn btn-primary">
                {{ isset($slider) ? 'Update' : 'Submit' }}
            </button>

        </form>

    </div>
</div>

@endsection