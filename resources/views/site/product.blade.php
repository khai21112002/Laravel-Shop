@extends('site.master')
@section('title', 'HomePage')
@section('body')
    <main>
        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>

                        Our <span>products</span>
                    </h2>
                </div>
                <div class="navproduct d-flex justify-content-between align-items-center">
                    <div class="categories">

                        <button type="button" class="category border-0 active" data-category=""
                            onclick="isActive(this); selectCategoryProduct(this)">All</button>
                        @foreach ($categories as $category)
                            <button type="button" class="category border-0" data-category="{{ $category->id }}"
                                onclick="isActive(this); selectCategoryProduct(this);">{{ $category->name }}</button>
                        @endforeach
                    </div>

                    <div class="searchbar">
                        <input id="search_input" class="search_input" type="text" name="search" placeholder="Search..."
                            onkeyup="searchProductsProduct()">
                        <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
                <br>
                <div class="row product-list">
                    @include('partials.product_list', ['products' => $products])
                </div>

            </div>
            <div class="pagination-custom">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </section>
    </main>
@stop()
