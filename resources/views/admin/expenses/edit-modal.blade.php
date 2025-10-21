<div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editExpenseForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editExpenseModalLabel">
                    <i class="bi bi-pencil-square me-2"></i> Edit Expense
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body bg-light">
                <input type="hidden" id="editExpenseId" name="id">

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select id="editCategory" name="category" class="form-select shadow-sm border-primary-subtle" required>
                        <option selected disabled value="">Select category</option>
                        <option value="Electric">Electric</option>
                        <option value="Rent">Rent</option>
                        <option value="Utilities">Utilities</option>
                        <option value="Supplies">Supplies</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Transportation / Fuel">Transportation / Fuel</option>
                        <option value="Communication">Communication</option>
                        <option value="Miscellaneous">Miscellaneous</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" id="editAmount" class="form-control" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" id="editDate" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="editDescription" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <div class="modal-footer bg-white border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save2 me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>