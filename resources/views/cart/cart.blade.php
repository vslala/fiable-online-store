<?php $panelHeading = "Cart"; $title="Fiable Cart";?>
@extends('master')

@section('content')

@include('_panel-heading')

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <table class="table table-responsive">
                <thead>
                    <th>Item</th>
                    <th>Quantity </th>
                    <th>Price</th>
                    <th>Delivery Details</th>
                    <th>Sub Total</th>
                </thead>

                <tbody>
                @foreach($cart as $c)

                    <tr id="table-row">
                        <td>{!! Html::image("img/products/".$c->image, $c->image,
                        ['class'=>'img img-responsive img-thumbnail',
                            'id'=>'cartItemImage'
                        ]
                        )
                         !!}<p></p>
                         <b>{{ $c->name }} </b>
                         </td>
                        <td>
                        <input type="hidden" value="{{ $c->pid }}" id="pid" >
                            <input type="number" value="1"
                            min="1"
                            max="5"
                            name="quantity"
                            id="quantity"
                            size="3"
                            {{--onchange="cart(this);"--}}
                             required/>
                            <input type="hidden" value="{{ $c->price }}" id="price" />

                        </td>
                        <td>{{ $c->price }} {!! Html::image('img/home/rupee-symbol.png', 'rupee') !!} </td>
                        <td>Shipping Free </td>
                        <td id="subtotal">{{ $c->price }} </td>
                        <td class="delete"><a href="{{ route('cartDelete', [
                            'pid'=>$c->pid,
                            'userID'=>$c->userID
                        ]) }}" class="close" id="deleteRow">&times;</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>

            <a href="{{ route("home") }}" style="font-weight: bolder; font-family: verdana, 'trebuchet ms', sans-serif;">Continue Shopping</a>

            <div class="amountPayable pull-right bg-danger" id="amountPayable">
                Total Amount Payable:
                <strong> <span id="amt"></span> {!! Html::image('img/home/rupee-symbol.png') !!} </strong>
            <div class="form-group">

            <div class="form-group pull-right">
             {!! Form::open(['route'=>['checkout'], 'method'=>'put', 'class'=>'form-vertical']) !!}
                    <input type="hidden" name="amountPayable" id="amtInput" />
                 {!! Form::submit('checkout', ['class'=>'btn btn-primary btn-lg']) !!}
             </div>
             {!! Form::close() !!}

            </div>



        </div>
    </div>
</div>
</div>


<div class="hidden">
    <a href="{{ route("insertQuantity") }}" id="insertQuantity"></a>
    {{--CSRF Token is compulsory if we are sending and post or put request to the server--}}
    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="csrf">
</div>
@endsection