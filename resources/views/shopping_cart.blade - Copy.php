@extends('layouts.sidebarnav')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js0"></script>
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
                            $subtotal = 0; ?>
                            @if(session('shopping_cart'))
                            @foreach(session('shopping_cart') as $id => $details)
                            <?php
                            $total += $details['price'] * $details['quantity'];
                            $subtotal = $details['price'] * $details['quantity'];
                            ?>

                            <tr>
                                <td>
                                    <figure class="itemside align-items-center">
                                        <figcaption class="info">
                                            <p class="title text-dark dish-name">{{ $details['name'] }}</p>
                                            <p class="text-muted small">
                                                @if($details['category'] == 'main_dish')
                                                Main Dish
                                                @elseif($details['category'] == 'appetizer')
                                                Appetizer
                                                @elseif($details['category'] == 'rice')
                                                Rice
                                                @elseif($details['category'] == 'beverage')
                                                Beverage
                                                @endif
                                            </p>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td>
                                    <input type="number" id="quantityCounter" class="form-control quantity" name="quantity" value="{{ $details['quantity'] }}" min="1" />
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price">Php. {{ $subtotal }}.00</var>
                                        <small class="text-muted" name="price"> Php. {{ $details['price'] }} </small>
                                        <small class="text-muted">each</small>
                                    </div>
                                </td>
                                <td class="text-right d-none d-md-block">
                                    <button class="btn btn-light remove-from-cart" data-abc="true" data-id="{{ $id }}">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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
                    <button class="btn btn-out btn-success btn-square btn-main mt-2 update-cart" 
                    data-id="
                    @if(session('shopping_cart'))
                    @foreach(session('shopping_cart') as $id => $details)
                    {{ $id }}
                    @endforeach
                    @endif">
                        Update Cart
                    </button>
                </div>
            </div>
        </aside>
    </div>
</div>
@include('modals.make_purchase_confirm')
<script type="text/javascript">
    $(function (){
        $(".update-cart").click(function (e) {
           e.preventDefault();
           var ele = $(this);
            $.ajax({
               url: '/update-cart',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: $("#quantityCounter").val()},
               success: function (data, textStatus, jqXHR) {
                   console.log(data);
                //    window.location.reload();
               },
               error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " " + errorThrown);
                },
            });
        });

        $(".remove-from-cart").click(function(e) {
        e.preventDefault();
        var ele = $(this);
        if (confirm("Are you sure")) {
            $.ajax({
                url: '/remove-from-cart',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
        });
    });
</script>
@endsection