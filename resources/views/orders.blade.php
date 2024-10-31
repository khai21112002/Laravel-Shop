@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="container-fluid main-container">
    <div class="row">
        <!-- Orders Section -->
        <div class="current-orders col-md-12">
            <div class="list-main-content">
                <div class="list-title pb-3">
                    <h3 class="fw-light">Available Orders</h3>
                </div>

                <!-- Search Form Section -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <form action="{{ url('search-engine/orders') }}" method="GET" id="searchOrder">
                            <input type="text" id="searchInput" value="{{ request('query') }}" name="query" class="form-control" placeholder="Search by order code, name, or phone" required>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit" form="searchOrder">Search</button>
                    </div>
                </div>
                
                <!-- Order List Section -->
                <div id="order-list" class="row">
                    @if ($orders->count() > 0)
                        @foreach ($orders as $order)
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4 col-sm-12">
                                                <h5 class="card-title">Order Code: {{ $order->order_code }}</h5>
                                                <p class="card-text"><strong>Name:</strong> {{ $order->fullname }}</p>
                                                <p class="card-text"><strong>Phone:</strong> {{ $order->phone }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <p class="card-text"><strong>Total Price:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
                                                <p class="card-text"><strong>Status:</strong> {{ $order->status }}</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <p class="card-text"><strong>Address:</strong> {{ $order->received_address }}</p>
                                                <p class="card-text"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                                                <p class="card-text"><strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-info" onclick="showOrderDetailModal({{ $order->id }})">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details Modal -->
                            <div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailModalLabel{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderDetailModalLabel{{ $order->id }}">Order Details - {{ $order->order_code }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Products in Order</h5>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderDetails as $detail)
                                                        <tr>
                                                            <td>{{ $detail->product_name }}</td>
                                                            <td>{{ $detail->quantity }}</td>
                                                            <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                                                            <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} VND</td>
                                                        </tr>
                                                    @endforeach
                                                    @if($order->orderDetails->isEmpty())
                                                        <tr>
                                                            <td colspan="4">No products in this order.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="mt-3">
                                                <strong>Total Amount: </strong>
                                                <span>{{ number_format($order->total_amount, 0, ',', '.') }} VND</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-3">
                                                    <label for="orderStatus">Update Order Status</label>
                                                    <select id="orderStatus" name="status" class="form-select" required>
                                                        <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Processing</option>
                                                        <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Completed</option>
                                                        <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No orders available.</p>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function showOrderDetailModal(orderId) {
        var modal = new bootstrap.Modal(document.getElementById('orderDetailModal' + orderId));
        modal.show();
    }

    function getStatusString(status) {
        const statusMapping = {
            0: 'Pending',
            1: 'Processing',
            2: 'Completed',
            3: 'Cancelled',
        };
        return statusMapping[status] || 'Unknown';
    }
</script>

@endsection
