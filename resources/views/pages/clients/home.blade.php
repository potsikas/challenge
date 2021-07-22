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
    <div class="col-lg-4 col-xs-12 mb-3">
        <div class="row justify-content-center">
            <a href="/clients" class="btn btn-lg btn-warning col-8" data-bs-toggle="modal" data-bs-target="#search">
                <i class="fa fa-search"></i>  Search client 
            </a>
             <!-- Modal -->
             <div class="modal fade" id="search" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">And new Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Search for</label>
                                    <input type="text" class="form-control" id="name" placeholder="Client" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
            <!--End Modal -->
        </div>
    </div>
    <div class="col-lg-4 col-xs-12 mb-3">
        <div class="row justify-content-center">
            <a href="/clients" class="btn btn-lg btn-success col-8">
                <i class="fa fa-list-alt"></i>  View all clients 
            </a>
        </div>
    </div>

</div>
<div class="row mt-5">
    <div class="col-12 table-responsive">
        <table class="table table-bordered" id="clients">
            <tr class="text-center">
                <th>
                    id
                </th>
                <th>
                    name
                </th>
                <th>
                    surname
                </th>
                <th>
                    actions
                </th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->id}}</td>
                    <td>{{ucfirst(strtolower($client->name))}}</td>
                    <td>{{ucfirst(strtolower($client->surname))}}</td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm btn-secondary"><i class="fa fa-info"></i></a>
                        <a href="" class="btn btn-sm btn-success"><i class="fas fa-dollar-sign"></i></a>
                        <a href="" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

    
    }); //end
    
    </script>
@endsection