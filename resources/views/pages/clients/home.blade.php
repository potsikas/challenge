@extends('layouts.main')

@section('title')
Clients main page
@endsection


@section('content')

<div class="row ">
    
    <div class="col-lg-4 col-xs-12 mb-3">
        <div class="row justify-content-center">
            <a href="/clients" class="btn btn-lg btn-primary col-8" data-bs-toggle="modal" data-bs-target="#new">
                <i class="fa fa-plus"></i> Add new client 
            </a>
            <!-- Modal -->
            <div class="modal fade" id="new" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">And new Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="newClient">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Client's name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="surename" class="form-label">Surname</label>
                                    <input type="text" class="form-control" id="surname" placeholder="Client's surname" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add New Client</button>
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
        <table class="table table-bordered" id="clients">
            <tr class="text-center">
                <th>
                    Id
                </th>
                <th>
                    Name
                </th>
                <th>
                    Surname
                </th>
                <th>
                    Last Payment
                </th>
                <th>
                    Actions
                </th>
            </tr>
            @foreach($clients as $client)
                <tr class="text-center">
                    <td>{{$client->id}}</td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->surname}}</td>
                    <td>
                        @if(!empty($client->payments[0]->created_at))
                        {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$client->payments[0]->created_at)->format('d/m/Y') }} - {{$client->payments[0]->amount}} &euro;
                        @else 
                        ------------
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#details_{{$client->id}}"><i class="fa fa-info"></i></a>
                        <!-- Modal -->
                        <div class="modal fade " id="details_{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Client details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-bordered text-center">
                                                    <tr>
                                                        <th colspan="5" class="h3">Client's details</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">
                                                            Surname
                                                        </td>
                                                        <td class="fw-bold">
                                                            Name
                                                        </td>
                                                        <td class="fw-bold">
                                                            Client Since
                                                        </td>
                                                        <td class="fw-bold">
                                                            Total Payments
                                                        </td>
                                                        <td class="fw-bold">
                                                            Total Amnount
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>{{$client->surname}}</td>
                                                        <td>{{$client->name}}</td>
                                                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$client->created_at)->format('d/m/Y')}}</td>
                                                        <td>{{$client->payments->count()}}</td>
                                                        <td>€ {{$client->total()}}</td>
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
                        <a href="" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#client_payments_{{$client->id}}"><i class="fas fa-dollar-sign"></i></a>
                         <!-- Modal -->
                         <div class="modal fade" id="client_payments_{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Client payments</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            @if($client->payments->count()>0)
                                            <div class="col-12 table-responsive">
                                                <table class="table table-bordered text-center">
                                                    <tr>
                                                        <th colspan="5" class="h3">Payment details</th>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-bold">
                                                            Id
                                                        </td>
                                                        <td class="fw-bold">
                                                            Payment Date
                                                        </td>
                                                        <td class="fw-bold">
                                                            Amount
                                                        </td>
                                                    </tr>
                                                    @foreach($client->payments as $payment)
                                                        <tr>
                                                            <td>{{$payment->id}}</td>
                                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$payment->created_at)->format('d/m/Y - H:i:s')}}</td>
                                                            <td>&euro; {{$payment->amount}}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                            @else
                                                <h3>There aren't payments yet...</h3>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                        <a href="" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit_client{{$client->id}}"><i class="fa fa-edit"></i></a>
                         <!-- Modal -->
                         <div class="modal fade" id="edit_client{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit client <i class="text-primary">{{$client->name.' '.$client->surname}}</i> </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" class="editForm"  id="editForm{{$client->id}}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control name" placeholder="Client's name" value="{{$client->name}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="surename" class="form-label">Surname</label>
                                                <input type="text" class="form-control surname" placeholder="Client's surname" value="{{$client->surname}}" required>
                                            </div>
                                        </div>
                                        <input type="hidden"  class="id"  value="{{$client->id}}" required>
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
                        <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_{{$client->id}}"><i class="fa fa-trash"></i></a>
                         <!-- Modal -->
                         <div class="modal fade" id="delete_{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Delete client  </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        @csrf
                                        <div class="modal-body">
                                            <h3>You are going to delete client:</h3>
                                            <h4><i class="text-primary">{{$client->name.' '.$client->surname}}</i></h4>
                                        </div>
                                        <div class="modal-footer">
                                        <form method="post" class="deleteForm"  action="/clients/delete/{{$client->id}}">
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete client</button>
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
    {!! $clients->links() !!}
</div>

@endsection

@section('javascript')
    
<script>
    $(document).ready(function() {
       
        //Add new client
        $("#newClient").on("submit",function(event){
            event.preventDefault();
            name = $("#name").val();
            surname = $("#surname").val();
            $.ajax({
                 url: "/clients/new",
                 type:"POST",
                 data:{
                    "_token": "{{ csrf_token() }}",
                    name:name,
                    surname:surname,
                 },
                 success:function(response){
                   $("#new").find(".results").html(response);
                   $(".alert-dismissible").delay(3000).slideUp(300);
                 },
                });
    
        });
        
        //Submit edit Form
        $("#clients").on("submit",".editForm ",function(event){
            event.preventDefault();
            var formID='#'+$(this).attr('id');  
            name = $(formID+" .name").val();
            surname = $(formID+" .surname").val();
            id = $(formID+" .id").val();

            $.ajax({
                url: "/clients/edit/"+id,
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    name:name,
                    surname:surname,
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