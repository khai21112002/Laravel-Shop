@extends('site.master')
@section('title', 'HomePage')
@section('body')
    <main>
        <div class="table-responsive">
                <div class="container">
                    <div class="heading_container heading_center mt-5">
                        <h2>
                           My Order
                        </h2>
                    </div>
                </div>
            <div class="navproduct d-flex justify-content-end align-items-center">
                <div class="searchbar">
                    <input id="search_input" class="search_input" type="text" name="search" placeholder="Search..."
                        oninput="searchOrder()">
                    <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                </div>
            </div>
            <br>
            <table class="table table-bordered table-striped table-hover table-primary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order Code</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Address</th>
                        <th>Payment method</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody id="myTable" class="table-group-divider order-list">
                        @include('partials.order_list', ['orders' => $orders])
                    </tbody>
            </table>
        </div>
        {{ $orders->links('pagination::bootstrap-5') }}
    </main>
@stop()
