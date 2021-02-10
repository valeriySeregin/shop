@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="{{ Storage::url($product->image) }}">
    <p>{{ $product->description }}</p>
    <form action="{{ route('cart-add', $product) }}" method="POST">
        <button type="sumbmit" class="btn btn-primary" role="button">Добавить в корзину</button>
        @csrf
    </form>
@endsection
