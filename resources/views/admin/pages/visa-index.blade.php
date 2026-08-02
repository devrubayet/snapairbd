@extends('admin.base')
@section('title',$site_infos->sitename .' | '. 'Visa Details')
@section('content')
@include('admin.components.visacount')
    @include('admin.components.visa-track')
    
@endsection
