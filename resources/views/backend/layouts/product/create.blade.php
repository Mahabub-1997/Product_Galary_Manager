@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-8 py-5 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Add New Product</h4>
                </div>
                <div class="card-body">
                    <div id="alertContainer"></div>
                    <form id="productForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Enter product description..."></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Product Images <small>(Multiple images allowed)</small></label>
                            <input type="file" id="imagesInput" name="images[]" class="form-control" multiple>
                        </div>

                        <div class="mb-3 d-flex flex-wrap" id="previewContainer" style="gap:5px;"></div>

                        <div class="form-group mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" name="status" value="1" checked> Active
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const productForm = document.getElementById('productForm');
        const imagesInput = document.getElementById('imagesInput');
        const previewContainer = document.getElementById('previewContainer');
        const alertContainer = document.getElementById('alertContainer');

        imagesInput.addEventListener('change', function(event){
            previewContainer.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                let img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.width = '100px';
                img.style.height = '80px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ddd';
                img.style.padding = '2px';
                previewContainer.appendChild(img);
            });
        });
        productForm.addEventListener('submit', function(e){
            e.preventDefault();

            let formData = new FormData(productForm);

            fetch("{{ route('products.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    alertContainer.innerHTML = '';

                    if(data.success){
                        alertContainer.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        setTimeout(() => {
                            window.location.href = "{{ route('products.index') }}";
                        }, 1000);

                    } else if(data.errors){
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        for(let key in data.errors){
                            errorHtml += `<li>${data.errors[key][0]}</li>`;
                        }
                        errorHtml += '</ul></div>';
                        alertContainer.innerHTML = errorHtml;
                    }
                })
                .catch(err => {
                    console.log(err);
                    alertContainer.innerHTML = `<div class="alert alert-danger">Something went wrong. Please try again.</div>`;
                });
        });
    </script>
@endsection
