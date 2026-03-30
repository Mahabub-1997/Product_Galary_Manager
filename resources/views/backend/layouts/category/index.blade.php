@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0 text-dark">Categories</h1>
                <a href="{{ route('categories.create') }}" class="btn bg-gradient-teal text-white btn-sm shadow-sm">
                    <i class="fas fa-plus-circle"></i> Add New Category
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

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        @if($categories->isEmpty())
                            <div class="p-5 text-center">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No categories found in the database.</p>
                                <a href="{{ route('categories.create') }}" class="btn btn-outline-teal btn-sm">Create First Category</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="categoryTable" class="table table-hover table-bordered">
                                    <thead class="bg-gradient-teal text-white">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="10%">Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th width="15%" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $key => $category)
                                        <tr>
                                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                                            <td class="align-middle text-center">
                                                @if($category->image)
                                                    <img src="{{ asset('storage/'.$category->image) }}"
                                                         style="width:60px;height:45px;object-fit:cover;border-radius:4px;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center rounded border" style="width:60px;height:45px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ $category->name }}</td>
                                            <td class="align-middle">{{ $category->description ?? '-' }}</td>
                                            <td class="align-middle"><code class="text-secondary">{{ $category->slug }}</code></td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center align-items-center" style="gap:5px;">
                                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#categoryTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    { "orderable": false, "targets": [1,5] }
                ]
            });
        });
    </script>
@endpush
