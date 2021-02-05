@extends('master')

@section('title', 'Товар')

@section('content')
    <div class="starter-template">
        <h1>iPhone X 64GB</h1>
        <h2>{{ $product }}</h2>
        <p>Цена: <b>71990 руб.</b></p>
        <img src="/storage/products/iphone_x.jpg">
        <p>Отличный продвинутый телефон с памятью на 64 gb</p>
        <a class="btn btn-success" href="/basket/1/add">Добавить в корзину</a>
    </div>
@endsection
