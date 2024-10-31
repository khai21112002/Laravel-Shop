@extends('layouts.apps')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox({
                buttons: [
                    "zoom",
                    "close"
                ],
                keyboard: true,
                closeClickOutside: true
            });
        });
    </script>
@endpush

@section('content')
    <main>
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($productImage as $image)
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto" src="{{ asset('storage/' . $image->img_url) }}"
                                                width="674" height="674" alt="{{ $product->name }}" />
                                            <a data-fancybox="gallery" href="{{ asset('storage/' . $image->img_url) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev">
                                    <svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg>
                                </div>
                                <div class="swiper-button-next">
                                    <svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnails -->
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($productImage as $image)
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto" src="{{ asset('storage/' . $image->img_url) }}"
                                                width="104" height="104" alt="{{ $product->name }}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="col-lg-5">
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>Category:</label>
                            <span>{{ $product->category->name }}</span>
                        </div>
                    </div>

                    <h1 class="product-single__name">{{ $product->name }}</h1>
                    <div class="product-single__price">
                        <span class="current-price">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Form Add to Cart Section -->
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product[id]" value="{{ $product->id }}">
                        <input type="hidden" name="product[name]" value="{{ $product->name }}">
                        <input type="hidden" name="product[price]" value="{{ $product->price }}">
                        <input type="hidden" name="product[category]" value="{{ $product->category->name}}">
                        <input type="hidden" name="product[image]" value="{{ asset('storage/' . $productImage[0]->img_url) }}">

                    
                        <div class="product-single__addtocart">
                            <div class="qty-control position-relative">
                                <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center">
                                <div class="qty-control__reduce">-</div>
                                <div class="qty-control__increase">+</div>
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
