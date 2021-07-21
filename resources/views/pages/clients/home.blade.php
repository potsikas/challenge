@extends('layouts.main')

@section('title')
Clients main page
@endsection


@section('content')
<div class="row mb-5">
    <div class="col-12 border-bottom">
        <h1>Clients </h1>
    </div>
</div>
<div class="row ">
    
    <div class="col-4">
        <div class="row justify-content-center">
            <a href="/clients" class="btn btn-lg btn-primary col-8">
                <i class="fa fa-plus"></i>  Add new client 
            </a>
        </div>
    </div>
    <div class="col-4">
        <div class="row justify-content-center">
            <a href="/clients" class="btn btn-lg btn-success col-8">
                <i class="fa fa-plus"></i>  Search client 
            </a>
        </div>
    </div>
    <div class="col-4">
        <div class="row justify-content-center">
            <a href="/clients" class="btn btn-lg btn-success col-8">
                <i class="fa fa-plus"></i>  View all clients 
            </a>
        </div>
    </div>
</div>
@endsection