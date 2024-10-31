
@if ($products->isNotEmpty())
    @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
                <div class="option_container">
                    <div class="options">
                        <a href="{{ route('shop.product.details',['product_slug' =>$product->slug]) }}" class="option1">Add To Cart</a>
                        <a href="{{ route('shop.product.details',['product_slug' =>$product->slug]) }}" class="option2">Buy Now</a>
                    </div>
                </div>
                <div class="img-box">
                    @if ($product->productImages->isNotEmpty())
                        <img src="{{ asset('storage/' .$product->productImages->first()->img_url) }}" alt="">
                    @else
                        <img src="images/defaultphone.webp" alt="">
                    @endif
                </div>
                <div class="detail-box">
                    <h5>{{ $product->name }}</h5>
                    <h6>{{ number_format($product->price, 0, ',', '.') }} VND</h6>
                </div>
            </div>
        </div>
    @endforeach
@else
    <h6 class="product-notfound">No Product Matches This Result</h6>
@endif