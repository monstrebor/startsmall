<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-blue-600 font-semibold text-[30px]">Edit Product</h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-1">
                        <label>Product Name</label>
                        <input type="text" id="edit-name" name="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-1">
                        <label>Category</label>
                        <select id="edit-category" name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="flex">
                        <div class="mb-1">
                            <label>Cost Price</label>
                            <input type="number" step="0.01" id="edit-cost-price" name="cost_price"
                                class="form-control">
                            @error('cost_price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-1">
                            <label>Selling Price</label>
                            <input type="number" step="0.01" id="edit-sell-price" name="sell_price"
                                class="form-control">
                            @error('sell_price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mb-1">
                        <label>Stock Quantity</label>
                        <input type="number" id="edit-stock-qty" name="stock_qty" class="form-control">
                        @error('stock_qty') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-1">
                        <label>Barcode</label>
                        <input type="text" id="edit-barcode" name="barcode" class="form-control">
                        @error('barcode') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-1">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-1" id="edit-image-preview" style="display: none;">
                        <label>Current Image</label><br>
                        <img src="" id="edit-image-src" class="w-24 h-24 object-cover rounded border">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>