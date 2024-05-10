@extends('layouts.appClient')

@section('title','Home')
@section('logo')
    @include('layouts.logo')
@endsection
@section('nav')
    @include('layouts.navBar')
@endsection

@section('content')
    <div
        class="alert alert-primary"
        role="alert"
    >
        <strong>Warning!</strong
        ><a href="#" class="alert-link">Click Here</a>
    </div>
    
    
@endsection

@section('footer')
    @include('layouts.footer')
@endsection