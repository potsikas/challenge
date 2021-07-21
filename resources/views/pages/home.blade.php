@extends('layouts.main')

@section('title')
Dashboard
@endsection


@section('content')
<div class="row mb-5">
    <div class="col-12 border-bottom">
        <h1>Spotawhell challenge</h1>
    </div>
</div>
<div class="row ">
    <div class="col-6">
        <div class="row justify-content-center">
            <a href="/clients" class="btn btn-lg btn-primary col-8">
                Clients
            </a>
        </div>
    </div>
    <div class="col-6">
        <div class="row justify-content-center">
            <a href="/payments" class="btn btn-lg btn-warning col-8">
                Payments
            </a>
        </div>
    </div>
</div>
@endsection