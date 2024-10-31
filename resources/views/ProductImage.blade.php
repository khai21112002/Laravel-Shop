@extends('layouts.admin')

@section('title', 'Manage Product Images')

@section('content')

<div class="container-fluid main-container">
    <div class="row">
        <!-- Products and Images Section -->
        <div class="current-products col-md-12">
            <div class="list-main-content">

                <div class="list-title pb-3">
                    <h3 class="fw-light">Uploaded Product Images</h3>
                </div>

                <div id="product-image-list" class="row">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="col-md-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <div class="row g-3">
                                            <!-- Product Information -->
                                            <div class="col-md-4 col-sm-12">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                                                <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                                <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                                            </div>
                                            <!--Carousel -->
                                            <div class="col-md-8 col-sm-12">
                                                <h6>Images</h6>
                                                <div id="carousel-{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @if ($product->productImages && $product->productImages->count() > 0)
                                                            @foreach ($product->productImages as $key => $image)
                                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                    <div class="position-relative">
                                                                        <img src="{{ asset('storage/'. $image->img_url) }}" class="d-block w-100" alt="Product Image" style="object-fit: contain; height: 150px;"> <!-- Reduced height -->
                                                                        <form method="POST" action="{{ route('ProductImage.destroy', $image->id) }}" class="delete-form">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-danger btn-sm delete-btn" type="submit">DELETE</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="carousel-item active">
                                                                <div class="position-relative">
                                                                    <img src="{{ asset('placeholder-image.jpg') }}" class="d-block w-100" alt="No Image Available" style="object-fit: contain; height: 150px;"> <!-- Reduced height -->
                                                                    <p>No images available</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                                <div class="text-center mt-3">
                                                    <button class="btn btn-primary" onclick="openAddImagesModal({{ $product->id }})">Add Images</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No products or images available.</p>
                    @endif
                </div>
            </div>
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Add Images Modal -->
<div class="modal fade" id="addImagesModal" tabindex="-1" aria-labelledby="addImagesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addImagesModalLabel">Add Images to Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addImagesForm" method="POST" action="{{ route('ProductImage.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="productId">

                    <div class="mb-3">
                        <label for="images" class="form-label">Upload Images</label>
                        <input type="file" name="images[]" class="form-control" id="images" multiple required>
                        <small class="form-text text-muted">You can select multiple images.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Images</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openAddImagesModal(productId) {
        document.getElementById('productId').value = productId;
        var modal = new bootstrap.Modal(document.getElementById('addImagesModal'));
        modal.show();
    }
</script>

@endsection
