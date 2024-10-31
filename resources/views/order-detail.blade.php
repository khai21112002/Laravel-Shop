@extends('layouts.apps')

@section('content')
    <main style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Order's Details</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wg-box mt-5 mb-5">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a class="btn btn-sm btn-danger" href="{{ url('/order') }}">Back</a>
                            </div>
                        </div>
                        <div class="order-complete">
                            <div class="order-info">
                                <div class="order-info__item">
                                    <label>Order Code</label>
                                    <span>{{ $order->order_code }}</span>
                                </div>
                                <div class="order-info__item">
                                    <label>Date</label>
                                    <span>{{ $order->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="order-info__item">
                                    <label>Total</label>
                                    <span>{{ number_format($order->total_amount, 0, ',', '.') }} VND</span>
                                </div>
                                <div class="order-info__item">
                                    <label>Payment Method</label>
                                    <span>{{ $order->payment_method_text }}</span>
                                </div>
                            </div>
                            <div class="checkout__totals-wrapper">
                                <div class="checkout__totals">
                                    <h3>Order Details</h3>
                                    <table class="checkout-cart-items">
                                        <thead>
                                            <tr>
                                                <th>PRODUCT</th>
                                                <th></th>
                                                <th>SUBTOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderDetails as $detail)
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><img
                                                            src="{{ $detail->product_img }}" width="60"
                                                            alt="{{ $detail->product_name }}"></td>
                                                    <td>{{ $detail->product_name }} x {{ $detail->quantity }}</td>
                                                    <td align="right">
                                                        {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}
                                                        VND</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>SUBTOTAL</th>
                                                <td align="right">{{ number_format($order->total_amount, 0, ',', '.') }}
                                                    VND</td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td align="right">Free shipping</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td align="right">0 VND</td>
                                            </tr>
                                            <tr>
                                                <th>TOTAL</th>
                                                <td align="right">{{ number_format($order->total_amount, 0, ',', '.') }}
                                                    VND</td>
                                            </tr>
                                            <tr>
                                                <th>STATUS</th>
                                                <td align="right">{{ $order->status_text }} </td>
                                            </tr>
                                            @if ($order->status == 3)
                                                <tr>
                                                    <th>CANCELED DATE</th>
                                                    <td align="right">{{ $order->updated_at->format('d/m/Y H:i:s') }}
                                                    </td>
                                                </tr>
                                            @elseif ($order->status == 2)
                                                <tr>
                                                    <th>DELIVERED DATE</th>
                                                    <td align="right">{{ $order->updated_at->format('d/m/Y H:i:s') }}
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <th>ESTIMATED DELIVERY DATE</th>
                                                    <td align="right">
                                                        {{ $order->created_at->addDays(3)->format('d/m/Y') }} </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-6">
                                @if ($order->status == 1)
                                    <form action="{{ route('order.receive') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-info">Received Order</button>
                                    </form>
                                @endif
                            </div>

                            <div class="wg-box col-6 text-right">
                                @if ($order->status == 0 || $order->status == 1)
                                    <form action="{{ route('order.cancel') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
@endsection
