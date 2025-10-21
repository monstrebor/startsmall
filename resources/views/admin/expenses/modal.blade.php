<div class="modal fade" id="createExpenseModal" tabindex="-1" aria-labelledby="createExpenseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('expenses.store') }}" method="POST" class="modal-content shadow-lg border-0 rounded-4">
            @csrf
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title d-flex align-items-center" id="createExpenseModalLabel">
                    <i class="bi bi-wallet2 me-2"></i> Add New Expense
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body bg-light">
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-list-ul me-1 text-primary"></i> Category
                    </label>
                    <select name="category" class="form-select shadow-sm border-primary-subtle" required>
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
                    <label class="form-label fw-semibold">
                        <i class="bi bi-cash-stack me-1 text-success"></i> Amount
                    </label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-success text-white">₱</span>
                        <input type="number" name="amount" class="form-control border-primary-subtle" step="0.01"
                            placeholder="Enter amount" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-calendar3 me-1 text-warning"></i> Date
                    </label>
                    <input type="date" name="date" class="form-control shadow-sm border-primary-subtle"
                        value="{{ now()->format('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-textarea-t me-1 text-info"></i> Description
                    </label>
                    <textarea name="description" class="form-control shadow-sm border-primary-subtle" rows="2"
                        placeholder="Optional notes..."></textarea>
                </div>
            </div>

            <div class="modal-footer bg-white border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-save2 me-1"></i> Save Expense
                </button>
            </div>
        </form>
    </div>
</div>