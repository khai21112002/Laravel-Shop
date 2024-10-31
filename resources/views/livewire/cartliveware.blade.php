<div>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Cart</h2>
            <div class="checkout-steps">
                <!-- Bỏ qua phần này để tiết kiệm không gian -->
            </div>

            <div class="shopping-cart">
                @if(count($products) > 0)
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
                            @php
                                $total = 0; 
                            @endphp
                            @foreach ($products as $product)
                                @php
                                    $subtotal = $product['price'] * $product['qty']; 
                                    $total += $subtotal; 
                                @endphp
                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <img loading="lazy" src="{{ $product['image'] }}" width="120" height="120" alt="{{ $product['name'] }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>{{ $product['name'] }}</h4>
                                            <ul class="shopping-cart__product-item__options">
                                                <li>{{ $product['category'] ?? 'N/A' }}</li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__product-price">{{ number_format($product['price'], 0, ',', '.') }} VND</span>
                                    </td>
                                    <td>
                                        <div class="qty-control position-relative">
                                            <input type="number" wire:model.lazy="products.{{ $loop->index }}.qty" min="1" class="qty-control__number text-center" required>
                                            <div class="qty-control__reduce" wire:click="updateQuantity('{{ $product['rowId'] }}', {{ $product['qty'] - 1 }})">-</div>
                                            <div class="qty-control__increase" wire:click="updateQuantity('{{ $product['rowId'] }}', {{ $product['qty'] + 1 }})">+</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__subtotal">{{ number_format($subtotal, 0, ',', '.') }} VND</span>
                                    </td>
                                    <td>
                                        <button wire:click="removeItem('{{ $product['rowId'] }}')" class="remove-cart">
                                            <svg width="15" height="15" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="cart-table-footer">
                            <button class="btn btn-light">UPDATE CART</button>
                        </div>
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
                                            <td>
                                                <div>Free shipping</div>
                                            </td>
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
                                <div class="button-wrapper container">
                                    <a href="checkout.html" class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 text-center pt-t bp-5">
                        <p>No item found in your cart</p>
                        <a href="{{ route('home.index') }}" class="btn btn-info">Shop NOW</a>
                    </div>   
                @endif
            </div>
        </section>
    </main>
</div>
