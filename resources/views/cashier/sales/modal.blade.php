<div class="modal fade" id="recordSaleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="saleForm" action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Record New Sale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Payment Type</label>
                        <select name="payment_type" class="form-select">
                            <option value="cash">Cash</option>
                            <option value="credit">Credit</option>
                        </select>
                    </div>

                    <div class="border rounded-md p-3 bg-gray-50">
                        <div class="grid grid-cols-5 font-semibold border-b pb-2 mb-2 text-gray-700 text-sm">
                            <div>Product</div>
                            <div>Qty</div>
                            <div>Price</div>
                            <div>Subtotal</div>
                            <div>Action</div>
                        </div>

                        <div id="product-list" class="space-y-2"></div>

                        <button type="button" id="addProductRow" class="text-blue-600 mt-3 text-sm font-medium">
                            + Add Product
                        </button>
                    </div>

                    <template id="product-options-template">
                        <option value="">Select product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->sell_price }}">
                                {{ $product->name }} (₱{{ number_format($product->sell_price, 2) }})
                            </option>
                        @endforeach
                    </template>

                    <div class="mt-4">
                        <label class="form-label font-semibold">Total: </label>
                        <span id="totalDisplay" class="text-lg text-green-600 font-bold">₱0.00</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Sale</button>
                </div>
            </div>
        </form>
    </div>
</div>