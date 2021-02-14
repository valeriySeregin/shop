@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина</h1>
    <p>Оформление заказа</p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Название</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products()->with('category')->get() as $product)
                <tr>
                    <td>
                        <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                            <img height="56px" src="{{ Storage::url($product->image) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $product->pivot->count }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('cart-remove', $product) }}" method="POST">
                                <button type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                </button>
                                @csrf
                            </form>
                            <form action="{{ route('cart-add', $product) }}" method="POST">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $product->price }} руб.</td>
                    <td>{{ $product->getTotalPrice() }} руб.</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">Общая стоимость:</td>
                <td>{{ $order->getTotalPrice() }} руб.</td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-success" href="{{ route('cart-order') }}">Оформить заказ</a>
        </div>
    </div>
@endsection
