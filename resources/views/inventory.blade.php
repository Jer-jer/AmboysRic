@extends('layouts.sidebarnav')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/inventory.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="inventory">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (Auth::user()->position == 'MANAGER')
                    <button type="button" class="btn add" data-toggle="modal" data-target="#addProduct">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table no-wrap user-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Product Name</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Status</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Category</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Price(Php.)</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="pl-4">{{ $product->id }}
                                <td>
                                    <h5 class="font-medium mb-0">{{ $product->product_name }}</h5>
                                </td>
                                <td>
                                    <h5 class="font-medium mb-0 @if($product->status == 'available') stats @else text-danger @endif">
                                        @if ($product->status == 'available')
                                        Available
                                        @else
                                        Not Available
                                        @endif
                                    </h5>
                                </td>
                                <td>
                                    <h5 class="font-medium mb-0">
                                        @if ($product->category == 'main_dish')
                                        Main Dish
                                        @elseif ($product->category == 'appetizer')
                                        Appetizer
                                        @elseif ($product->category == 'rice')
                                        Rice
                                        @elseif ($product->category == 'beverage')
                                        Beverage
                                        @endif
                                    </h5>
                                </td>
                                <td>
                                    <h5 class="font-medium mb-0">{{ $product->price }}</h5>
                                </td>
                                <!-- <td>
                                    <span class="text-muted">15 Mar 1988</span><br>
                                    <span class="text-muted">10: 55 AM</span>
                                </td> -->
                                @if (Auth::user()->position == 'MANAGER')
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle editProd" data-id="{{ $product->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="delete_product/{{$product->id}}" class="delIcon">
                                        <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle delProd" data-id="{{ $product->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                    @if ($product->status == 'available')
                                    <a href="{{ url('add-to-cart/'.$product->id) }}" class="delIcon">
                                        <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                    @endif
                                </td>
                                @else
                                <td>
                                    @if ($product->status == 'available')
                                    <a href="{{ url('add-to-cart/'.$product->id) }}" class="delIcon">
                                        <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.editProd', function() {
        var prod_id = $(this).data('id');
        $.ajax({
            url: '/edit_product',
            type: 'GET',
            data: 'id=' + prod_id,
            dataType: 'JSON',
            success: function(data, textStatus, jqXHR) {
                console.log(data);
                $(".modal-body #id").val(data.id);
                $(".modal-body #product-name").val(data.product_name);
                $(".modal-body #stats").val(data.status);
                $(".modal-body #category").val(data.category);
                $(".modal-body #price").val(data.price);
                $('#editProduct').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + "" + errorThrown);
            },
        });
    });
</script>
@include('modals.auth.add_product')
@include('modals.auth.edit_product')
@include('modals.alert')
@endsection