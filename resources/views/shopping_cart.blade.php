@extends('layouts.sidebarnav')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/shopping_cart.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <aside class="col-lg-9">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Product</th>
                                <th scope="col" width="120">Quantity</th>
                                <th scope="col" width="120">Price</th>
                                <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;
                            $subtotal = 0;
                            ?>
                            @foreach($products as $product)
                            <?php
                            $total += $product['price'] * $product['quantity'];
                            $subtotal = $product['price'] * $product['quantity'];
                            ?>
                            <tr>
                                <td>
                                    <figure class="itemside align-items-center">
                                        <figcaption class="info">
                                            <p class="title text-dark dish-name">{{ $product['product_name'] }}</p>
                                            <p class="text-muted small">
                                                @if($product['category'] == 'main_dish')
                                                Main Dish
                                                @elseif($product['category'] == 'appetizer')
                                                Appetizer
                                                @elseif($product['category'] == 'rice')
                                                Rice
                                                @elseif($product['category'] == 'beverage')
                                                Beverage
                                                @endif
                                            </p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <input type="number" id="quantityCounter" class="form-control quantity" name="quantity" value="{{ $product['quantity'] }}" min="1" />
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price">Php. {{ $subtotal }}.00</var>
                                        <small class="text-muted" name="price"> Php. {{ $product['price']}} </small>
                                        <small class="text-muted">each</small>
                                    </div>
                                </td>
                                <td class="text-right d-none d-md-block">
                                    <a href="{{ url('remove-from-cart/'.$product['product_id']) }}" class="btn btn-light" data-abc="true">
                                        Remove
                                    </a>
                                    <button class="btn btn-update update-cart" data-id="{{ $product['product_id'] }}">
                                        Update
                                    </button>
                                    <!-- <a href="{{ url('update-cart'.$product['product_id']) }}" class="btn btn-update" data-abc="true">
                                        Update
                                    </a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
        <aside class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <dl class="dlist-align">
                        <dt>Total price:</dt>
                        <dd class="text-right text-dark b ml-3"><strong>Php. {{ $total }}.00</strong></dd>
                    </dl>
                    <hr>
                    <button class="btn btn-out btn-peach btn-square btn-main" data-abc="true" data-toggle="modal" data-target="#confirm">
                        Make Purchase
                    </button>
                    <button class="btn btn-out btn-peach btn-square btn-main mt-2" data-abc="true" data-toggle="modal" data-target="#receipts">
                        Receipts
                    </button>
                </div>
            </div>
        </aside>
    </div>
</div>
@include('modals.receipts')
@include('modals.make_purchase_confirm')
<script type="text/javascript">
    var $counter = 0;
    var $quantityCounter;
    $("input[type=number]").change(function() {
        $quantityCounter = $(this).val();
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.update-cart', function(e) {
        e.preventDefault();
        var prod_id = $(this).data('id');
        var data = {
            id: prod_id,
            quantity: $quantityCounter
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/update-cart',
            type: 'patch',
            data: data,
            dataType: 'JSON',
            success: function(data, textStatus, jqXHR) {
                window.location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + "" + errorThrown);
            },
        });
    });
</script>
@endsection