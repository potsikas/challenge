@extends('layouts.main')

@section('title')
Payments main page
@endsection


@section('content')

<div class="row ">
    
    <div class="col-lg-4 col-xs-12 mb-3">
        <div class="row justify-content-center">
            <a href="/payments" class="btn btn-lg btn-primary col-8" data-bs-toggle="modal" data-bs-target="#new">
                <i class="fa fa-plus"></i> Add new payment 
            </a>
            <!-- Modal -->
            <div class="modal fade" id="new" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">And new payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="newPayment">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="client" class="form-label">Client</label>
                                    <select class="form-select" aria-label="client" required name="client" id="client">
                                        <option value="" selected>Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->surname.' '.$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="surename" class="form-label">Payment</label>
                                    <input type="text" class="form-control" id="payment" placeholder="Payment Amount" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add New Payment</button>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-11 results"></div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
            <!--End Modal -->
        </div>
    </div>
    
   

</div>
<div class="row mt-5">
    <div class="col-12 table-responsive">
        <table class="table table-bordered" id="payments">
            <tr class="text-center">
                <th>
                    Id
                </th>
                <th>
                    Client
                </th>
                <th>
                    Payment
                </th>
                <th>
                    Payment Timestamp
                </th>
                <th>
                    Actions
                </th>
            </tr>
            @foreach($payments as $payment)
                <tr>
                    <td>{{$payment->id}}</td>
                    <td>{{$payment->client->surname.' '.$payment->client->name}}</td>
                    <td>&euro; {{$payment->amount}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$payment->created_at)->format('d/m/Y - H:i:s'  )}}</td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#details_{{$payment->id}}"><i class="fa fa-info"></i></a>
                        <!-- Modal -->
                        <div class="modal fade" id="details_{{$payment->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Payment <i class="text-primary">{{$payment->id}}</i> details  </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th colspan="5" class="h3">Payment details</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">
                                                            Client
                                                        </td>
                                                        <td class="fw-bold">
                                                            Client Since
                                                        </td>
                                                        <td class="fw-bold">
                                                            Payment created
                                                        </td>
                                                        <td class="fw-bold">
                                                            Payment updated
                                                        </td>
                                                        <td class="fw-bold">
                                                            Payment amount
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$payment->client->surname.' '.$payment->client->name}}</td>
                                                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$payment->client->created_at)->format('d/m/Y')}}</td>
                                                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$payment->created_at)->format('d/m/Y - H:i:s')}}</td>
                                                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$payment->updated_at)->format('d/m/Y - H:i:s')}}</td>
                                                        <td>{{$payment->amount}}</td>

                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div> 
                        </div>
                        <!--End Modal -->
                        <a href="" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit_payment{{$payment->id}}"><i class="fa fa-edit"></i></a>
                         <!-- Modal -->
                         <div class="modal fade" id="edit_payment{{$payment->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit payment <i class="text-primary">{{$payment->id}}</i> </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" class="editForm"  id="editForm{{$payment->id}}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="client" class="form-label">Client</label>
                                                <select class="form-select client" aria-label="client" required name="client" disabled>
                                                        <option value="{{$payment->user_id}} SELECTED">{{$payment->client->surname.' '.$payment->client->name}}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="surename" class="form-label">Payment</label>
                                                <input type="text" class="form-control payment" placeholder="Payment Amount" value="{{$payment->amount}}" required>
                                            </div>
                                            <input type="hidden"  class="id"  value="{{$payment->id}}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-11 results"></div>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                        <!--End Modal -->
                        <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_{{$payment->id}}"><i class="fa fa-trash"></i></a>
                         <!-- Modal -->
                         <div class="modal fade" id="delete_{{$payment->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Delete payment  </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        @csrf
                                        <div class="modal-body">
                                            <h3>You are going to delete payment:</h3>
                                            <h4>Client: <i class="text-primary">{{$payment->client->name.' '.$payment->client->surname}}</i></h4>
                                            <h4>Amount: <i class="text-danger">&euro; {{$payment->amount}}</i></h4>
                                        </div>
                                        <div class="modal-footer">
                                        <form method="post" class="deleteForm"  action="/payments/delete/{{$payment->id}}">
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete payment</button>
                                        </form>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-11 results"></div>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                        <!--End Modal -->
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="d-flex justify-content-center mt-5">
    {!! $payments->links() !!}
</div>

@endsection

@section('javascript')
    
<script>
    $(document).ready(function() {
       
        //Add new payment
        $("#newPayment").on("submit",function(event){
            event.preventDefault();
            client = $("#client").val();
            payment = $("#payment").val();
            $.ajax({
                 url: "/payments/new",
                 type:"POST",
                 data:{
                    "_token": "{{ csrf_token() }}",
                    client:client,
                    payment:payment,
                 },
                 success:function(response){
                   $("#new").find(".results").html(response);
                   $(".alert-dismissible").delay(3000).slideUp(300);
                 },
                });
    
        });
        
        //Submit edit Form
        $("#payments").on("submit",".editForm ",function(event){
            event.preventDefault();
            var formID='#'+$(this).attr('id');  
            payment = $(formID+" .payment").val();
            client = $(formID+" .client").val();
            id = $(formID+" .id").val();

            $.ajax({
                url: "/payments/edit/"+id,
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    payment:payment,
                    client:client,
                },
                success:function(response){
                    $(formID).find(".results").html(response);
                    $(".alert-dismissible").delay(3000).slideUp(300);
               },
            });

         });
    
    }); //end
    
    </script>
@endsection