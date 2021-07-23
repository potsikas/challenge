@extends('layouts.main')

@section('title')
Payments main page
@endsection


@section('content')
<div class="row mb-3">
    <div class="col-12">
        <h4>Latest payment of each client from <i class="text-primary">{{$startDate->format('d/m/y')}}</i> to: <i class="text-primary">{{$endDate->format('d/m/y')}}</i></h4>
    </div>
</div>
<div class="col-12 table-responsive">
    <table class="table table-bordered" id="payments">
        <tr class="text-center">
            <th>
                Payment Id
            </th>
            <th>
                Client
            </th>
            <th>
                Payment Date
            </th>
            <th>
                Payment Amount
            </th>
        </tr>
        @foreach($records as $payment)
            <tr class="text-center">
                <td>
                    {{$payment->id}}
                </td>
                <td>
                    {{$payment->client->surname.' '.$payment->client->name}}
                </td>
                <td>
                    {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$payment->created_at)->format('d/m/y')}}
                </td>
                <td>
                    &euro; {{$payment->amount}}
                </td>
   
            </tr>
        @endforeach
    </table>
</div>
<div class="row mt-3 text-end">
    <div class="col-12">
        <a href="/" class="btn btn-primary btn-sm">New Search</a>
    </div>
</div>

@endsection
