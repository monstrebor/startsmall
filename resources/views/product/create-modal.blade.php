<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-3xl" id="createProductModalLabel">Create New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        {{-- Product Name --}}
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter product name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Cost Price --}}
                        <div class="col-md-4">
                            <label class="form-label">Cost Price</label>
                            <input type="number" step="0.01" name="cost_price"
                                class="form-control @error('cost_price') is-invalid @enderror" placeholder="₱0.00"
                                value="{{ old('cost_price') }}">
                            @error('cost_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Selling Price --}}
                        <div class="col-md-4">
                            <label class="form-label">Selling Price</label>
                            <input type="number" step="0.01" name="sell_price"
                                class="form-control '@error('sell_price') is-invalid @enderror'" placeholder="₱0.00"
                                value="{{ old('sell_price') }}">
                            @error('sell_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stock Quantity --}}
                        <div class="col-md-4">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" name="stock_qty"
                                class="form-control @error('stock_qty') is-invalid @enderror" placeholder="0"
                                value="{{ old('stock_qty') }}">
                            @error('stock_qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Barcode --}}
                        <div class="col-md-6">
                            <label class="form-label">Barcode</label>
                            <input type="text" name="barcode"
                                class="form-control @error('barcode') is-invalid @enderror" placeholder="Enter barcode"
                                value="{{ old('barcode') }}">
                            @error('barcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Product Image (optional) --}}
                        <div class="col-md-6">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="image" accept="image/*"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>