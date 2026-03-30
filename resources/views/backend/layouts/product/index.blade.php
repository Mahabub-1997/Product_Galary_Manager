@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0 text-dark">Products</h1>
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm shadow-sm">
                    <i class="fas fa-plus-circle"></i> Add New Product
                </a>
            </div>
        </div>

        <section class="content mt-3">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="icon fas fa-check"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-primary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Images</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{ $products->firstItem() + $key }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name ?? '-' }}</td>
                                        <td>{{ Str::limit($product->description, 50) }}</td>
                                        <td>
                                            @foreach($product->images as $img)
                                                <img src="{{ url('storage/'.$img->image) }}"
                                                     alt="Product Image"
                                                     style="width:50px;height:40px;object-fit:cover;margin-right:3px;">
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($product->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap:5px;">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                   class="btn btn-sm btn-outline-primary" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                   class="btn btn-sm btn-outline-info" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this product and all its images?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $products->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
