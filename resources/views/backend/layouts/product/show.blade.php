@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid py-5">

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Product Card -->
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Product Details</h4>
                        </div>
                        <div class="card-body">

                            <!-- Product Info -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="text-secondary">Name</h6>
                                    <p class="fw-bold">{{ $product->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-secondary">Category</h6>
                                    <p class="fw-bold">{{ $product->category->name ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-secondary">Description</h6>
                                <p class="text-muted">{{ $product->description ?? '-' }}</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-secondary">Status</h6>
                                @if($product->status)
                                    <span class="badge bg-success px-3 py-2">Active</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2">Inactive</span>
                                @endif
                            </div>

                            <!-- Images Gallery -->
                            <div class="mb-4">
                                <h6 class="text-secondary mb-2">Images</h6>
                                <div class="row g-3">
                                    @forelse($product->images as $img)
                                        <div class="col-4 col-md-3">
                                            <div class="position-relative overflow-hidden rounded shadow-sm">
                                                <img src="{{ asset('storage/'.$img->image) }}"
                                                     alt="Product Image"
                                                     class="img-fluid"
                                                     style="height:120px; width:100%; object-fit:cover;">
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">No images available.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Product
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- End Product Card -->

                </div>
            </div>

        </div>
    </div>
@endsection

