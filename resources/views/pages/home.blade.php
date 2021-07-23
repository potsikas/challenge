@extends('layouts.main')

@section('title')
Dashboard
@endsection

@section('css')
    <link rel="stylesheet"  type="text/css" href="/css/datepicker.css">
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-8">
        <h4>Select a date range to see the latest payment of each client:</h4>
    </div>
    <div class="col-4 text-end">
        <a href="/payments/export" class="btn btn-success">Export payments</a>
    </div>
</div>
<div class="row">
    <form method="post" class="form row" action="/payments/latest">
        @csrf
        <div class="col-md-4">
            <label for="startDate" class="form-label">
                From Date:
            </label>
            <div class="input-group">
                <div class="input-group-text ">
                    <i  class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control datepicker"  autocomplete="off" required name="startDate" id="startDate" value="{{ old('startDate') }}">
            </div>
        </div>
        <div class="col-md-4">
            <label for="endDate" class="form-label">
                To Date:
            </label>
            <div class="input-group">
                <div class="input-group-text ">
                    <i  class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control datepicker"  autocomplete="off" required name="endDate" id="endDate" value="{{ old('endDate') }}" >
            </div>
        </div>
        <div class="col-md-4">
            <label for="submit" class="form-label">
                &nbsp;
            </label>
            <div class="input-group">
                <input type="submit" class="btn btn-primary" value="Search"  name="submit" id="submit" >
            </div>
        </div>
    </form>
</div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            //Datepicker settings
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                clearBtn: true,
                todayHighlight: true,
                weekStart:1,
                autoclose: true,
            });
            
        });//end
    </script>
    <script src="/js/datepicker.js" ></script>
@endsection