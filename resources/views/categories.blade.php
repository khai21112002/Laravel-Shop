@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container-fluid main-container">
    <div class="row">
        <div class="current-categories col-md-7 col-sm-6">
            <div class="list-main-content">
                <div class="list-title pb-3">
                    <h3 class="fw-light">Available Categories</h3>
                </div>
                
                <div id="categories-list">
                    @if($categories->count() > 0)
                        @foreach ($categories as $category)
                            <div class="card mb-3" id="category-{{ $category->id }}">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">{{ $category->name }}</h5>
                                        <p class="card-text">Created at {{ $category->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <button class="btn btn-warning" onclick="openUpdateModal({{ $category->id }}, '{{ $category->name }}')">Update</button>
                                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No categories available.</p>
                    @endif
                </div>
            </div>
            <div class="pagination-container">
                {{ $categories->links() }}
            </div>
        </div>

        <div class="form-category col-md-5 col-sm-6">
            <div class="form-main-title">
                <h3 class="fw-light">Add New Category</h3>
            </div>
            <div class="form-main-content">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" name="categoryName" class="form-control" id="categoryName" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Add Category</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateCategoryForm" method="POST" action="">
                        @csrf
                        @method("PUT")
                        <input type="hidden" id="updateCategoryId" name="categoryId">
                        <div class="mb-3">
                            <label for="updateCategoryName" class="form-label">Category Name</label>
                            <input type="text" name="categoryName" class="form-control" id="updateCategoryName" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openUpdateModal(id, name) {
        document.getElementById('updateCategoryId').value = id;
        document.getElementById('updateCategoryName').value = name;
        document.getElementById('updateCategoryForm').setAttribute('action', `/categories/${id}`);

        const modal = new bootstrap.Modal(document.getElementById('updateCategoryModal'));
        modal.show();
    }
</script>
@endsection
