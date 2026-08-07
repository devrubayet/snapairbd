@extends('admin.base')
@section('title', $settings->site_name . ' | ' . 'Admin Dashboard')
@section('content')

    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <x-admin.card  title="Settings"
    :link=" route('settings-edit')" desc='Site Settings Here' color='warning' iconcolor="danger" icon="mdi mdi-information" />

        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

            <x-admin.card title="Feedback" :count="$feedbackCount" :link="route('all-testi')" desc='Slider Control.' iconcolor='warning' color="info" icon="mdi-image-multiple" />

        </div>
    </div>





@endsection
