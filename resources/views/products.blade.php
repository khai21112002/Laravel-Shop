@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('existsProduct'))
    <div class="alert alert-danger">
        {{ session('existsProduct') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid main-container">
    <div class="row">
        <div class="current-products col-md-8">
            <div class="list-main-content">
                <div class="list-title pb-3">
                    <h3 class="fw-light">Available Products</h3>
                </div>

                <!-- Search form section -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <form id="searchProduct" method="GET" action="{{ url('search-engine/products') }}">
                            <input type="text" name="query" value="{{ request('query') }}" class="form-control" placeholder="Search by product name or category" required>
                            
                        </form>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit" form="searchProduct">Search</button>
                    </div>
            
                </div>

                <!-- Product list section -->
                <div id="product-list" class="row">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <!-- First Column -->
                                            <div class="col-md-4 col-sm-12">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">{!! $product->description !!}</p>
                                            </div>

                                            <!-- Second Column -->

                                            <div class="col-md-4 col-sm-12">
                                                <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                                                <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                            </div>

                                            <!-- Third Column -->

                                            <div class="col-md-4 col-sm-12">
                                                <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                                                <p class="card-text"><strong>Slug:</strong> {{ $product->slug }}</p>
                                            </div>
                                        </div>
                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-warning" 
                                                    onclick="openUpdateModal({{ $product->id }}, '{{ $product->name }}', '{{ addslashes($product->description) }}', {{ $product->stock }}, {{ $product->price }}, {{ $product->category_id }}, '{{ addslashes($product->slug) }}')">
                                                Update
                                            </button>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No products available.</p>
                    @endif
                </div>
            </div>

            <!-- Pagination links -->
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </div>

        <!-- Add New Product Form -->
        <div class="col-md-4">
            <h3 class="fw-light">Add New Product</h3>
            <form id="addProductForm" method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" id="productName" required>
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="productDescription" rows="3" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="productStock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" id="productStock" required>
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" id="productPrice" required>
                </div>
                <div class="mb-3">
                    <label for="categoryId" class="form-label">Category</label>
                    <select name="category_id" id="categoryId" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="productSlug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" id="productSlug" required>
                </div>
                <button class="btn btn-primary" type="submit">Add Product</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProductModalLabel">Update Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateProductForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="updateProductName" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" id="updateProductName" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateProductDescription" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="updateProductDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="updateProductStock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" id="updateProductStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateProductPrice" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" id="updateProductPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateCategoryId" class="form-label">Category</label>
                        <select name="category_id" id="updateCategoryId" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateProductSlug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" id="updateProductSlug" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}">
</script>
<script>
    tinymce.init({
        selector: '#productDescription, #updateProductDescription', 
        plugins: 'link image code',
        license_key: 'gpl',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
    });


    // Trigger TinyMCE save on form submission to ensure the content is saved
    document.getElementById('addProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        tinymce.triggerSave(); // Ensures TinyMCE content is saved back to the original textarea
        this.submit(); // Submits the form
    });

    document.getElementById('updateProductForm').addEventListener('submit', function(e) {
        e.preventDefault();
        tinymce.triggerSave();
        this.submit();
    });

    function openUpdateModal(id, name, description, stock, price, categoryId, slug) {
        document.getElementById('updateProductForm').action = "{{ url('products') }}/" + id;
        document.getElementById('updateProductName').value = name;
        document.getElementById('updateProductDescription').value = description;
        document.getElementById('updateProductStock').value = stock;
        document.getElementById('updateProductPrice').value = price;
        document.getElementById('updateCategoryId').value = categoryId;
        document.getElementById('updateProductSlug').value = slug;

        var modal = new bootstrap.Modal(document.getElementById('updateProductModal'));
        modal.show();
    }

</script>


@endsection
