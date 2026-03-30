@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Category</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name', $category->name) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Enter category description...">{{ old('description', $category->description) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Category Image</label>
                            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                        </div>

                        <div class="mb-3">
                            <img id="preview"
                                 src="{{ $category->image ? asset('storage/'.$category->image) : '' }}"
                                 style="width:150px;height:120px;object-fit:cover;border:1px solid #ddd;padding:5px;{{ $category->image ? '' : 'display:none;' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" name="status" value="1" {{ $category->status ? 'checked' : '' }}> Active
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            let image = document.getElementById('preview');
            let file = event.target.files[0];

            if (file) {
                image.src = URL.createObjectURL(file);
                image.style.display = "block";
            }
        }
    </script>
@endsection
