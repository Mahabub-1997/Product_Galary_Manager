@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form id="productForm" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" name="status" value="1" {{ $product->status ? 'checked' : '' }}> Active
                        </div>

                        <div class="form-group mb-3">
                            <label>Existing Images</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->images as $img)
                                    <div class="img-box position-relative d-inline-block" style="width:100px;height:80px;margin:10px;">
                                        <img src="{{ asset('storage/'.$img->image) }}" style="width:100%;height:100%;object-fit:cover;border:1px solid #ddd;padding:2px;">
                                        <button type="button" onclick="deleteImage({{ $img->id }}, this)"
                                                style="position:absolute;top:-8px;right:-8px;background:red;color:white;width:20px;height:20px;border:none;border-radius:50%;font-size:14px;">×</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Add New Images</label>
                            <input type="file" name="images[]" class="form-control" multiple onchange="uploadNewImages(event)">
                        </div>

                        <div class="mb-3 d-flex flex-wrap gap-2" id="newPreview"></div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function uploadNewImages(event) {
            let preview = document.getElementById('newPreview');
            preview.innerHTML = '';
            let files = event.target.files;
            let formData = new FormData();

            Array.from(files).forEach(file => {
                let img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.width = '100px';
                img.style.height = '80px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ddd';
                img.style.padding = '2px';
                preview.appendChild(img);

                formData.append('images[]', file);
            });

            formData.append('product_id', '{{ $product->id }}');

            fetch("{{ route('products.image.upload') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Image(s) uploaded successfully!');
                        window.location.href = "{{ route('products.index') }}";
                    } else {
                        alert('Upload failed!');
                    }
                })
                .catch(err => {
                    console.log(err);
                    alert('Error uploading images');
                });
        }
        function deleteImage(id, el) {
            if(!confirm('Delete this image?')) return;

            fetch(`/product/image/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if(data.success){
                        el.closest('.img-box').remove();
                    } else {
                        alert('Delete failed');
                    }
                })
                .catch(() => alert('Error deleting image'));
        }
    </script>
@endsection

