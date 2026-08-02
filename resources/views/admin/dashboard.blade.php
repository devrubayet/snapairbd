@extends('admin.base')
@section('title', $settings->site_name . ' | ' . 'Admin Dashboard')
@section('content')

    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <x-admin.card  title="Settings"
    :link=" route('settings-edit')" icon="mdi mdi-information" />

        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">

            <x-admin.card title="Feedback" :count="$feedbackCount" :link="route('all-testi')" color="blue" icon="mdi-image-multiple" />

        </div>
    </div>





@endsection
