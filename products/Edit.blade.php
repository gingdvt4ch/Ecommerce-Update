@extends('dashboard.index')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <a class="btn btn-secondary btn-sm" href="{{ route('products.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Products
    </a>
    <h2 class="text-dark mb-0">Edit Product</h2>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow-sm rounded-lg p-5">
    <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="Enter Product Name" required>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" 
                                @if ($category->category_id == $product->category_id) selected @endif>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <strong>Brand:</strong>
                    <select name="brand_id" class="form-control" required>
                        <option value="">-- Select Brand --</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->brand_id }}" 
                                @if ($brand->brand_id == $product->brand_id) selected @endif>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <strong>Stock Quantity:</strong>
                    <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" class="form-control" placeholder="Enter Stock Quantity" required>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <strong>Stock Status:</strong>
                    <select name="stock_status" class="form-control">
                        <option value="In Stock" @if($product->stock_status == 'In Stock') selected @endif>In Stock</option>
                        <option value="Out of Stock" @if($product->stock_status == 'Out of Stock') selected @endif>Out of Stock</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="number" step="0.01" name="product_price" value="{{ $product->product_price }}" class="form-control" placeholder="Enter Price" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" rows="5" placeholder="Enter Product Description" required>{{ $product->description }}</textarea>
                </div>
            </div>

            <!-- Product Image -->
            <div class="col-md-4 mb-4">
                <div class="form-group">
                    <strong>Product Image:</strong>
                    <input type="file" name="product_image" class="form-control">
                    @if ($product->product_image)
                        <div class="mt-2">
                            <strong>Current Image:</strong><br>
                            
                            <img src="{{ asset('images/' . $product->product_image) }}" alt="Product Image" style="max-width: 150px; max-height: 150px;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save"></i> Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection
