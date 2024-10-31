@extends('layouts.apps')

@section('content')
    <main >
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Cart</h2>
            <div class="checkout-steps">
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>

            <div class="shopping-cart">
                @if ($products->count() > 0)
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                <img loading="lazy" src="{{ $product->options->image }}" width="120" height="120" alt="{{ $product->name }}" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4>{{ $product->name }}</h4>
                                                <ul class="shopping-cart__product-item__options">
                                                    <li>{{ $product->options->category ?? 'N/A' }}</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.update', $product->rowId) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="qty-control position-relative">
                                                    <button type="submit" class="btn btn-light" style="display: none;">Update</button>
                                                    <input type="number" name="quantity" value="{{ $product->qty }}" min="1" class="qty-control__number text-center" required>
                                                    <div class="qty-control__reduce">
                                                        <button type="submit" class="btn-update-quantity">-</button>
                                                    </div>
                                                    <div class="qty-control__increase">
                                                        <button type="submit" class="btn-update-quantity">+</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__subtotal">{{ number_format($product->price * $product->qty, 0, ',', '.') }} VND</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="remove-cart">
                                                    <svg width="15" height="15" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                        <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="cart-table-footer">
                                <button type="submit" class="btn btn-danger">CLEAR CART</button>
                            </div>
                        </form>
                    </div>
                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>Cart Totals</h3>
                                <table class="cart-totals">
                                    <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>{{ number_format($total, 0, ',', '.') }} VND</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td><div>All World</div></td>
                                        </tr>
                                        <tr>
                                            <th>VAT</th>
                                            <td>0 VND</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>{{ number_format($total, 0, ',', '.') }} VND</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mobile_fixed-btn_wrapper">
                                @guest
                                    <p>You need to <a href="{{ route('login') }}"> LOG IN</a> to purchase items. </br>
                                        If you don't have an account, <a href="{{ route('register') }}">REGISTER </a> here.
                                    </p>
                                @else
                                    <div class="button-wrapper container">
                                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-12 text-center pt-t bp-5">
                        <p>No item found in your cart</p>
                        <a href="{{ route('site.product') }}" class="btn btn-info">SHOP NOW</a>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection
