<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="/storage/products/iphone_x.jpg" alt="{{ $product->name }}">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }}</p>
            <p>
                <a href="{{ route('cart') }}" class="btn btn-primary" role="button">В корзину</a>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default"
                    role="button">Подробнее</a>
            </p>
        </div>
    </div>
</div>
