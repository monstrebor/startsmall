<div class="container mt-4">
    @include('layout.all-notif')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Store Expenses</h4>
        <div class="flex">
            <a href="{{ route('profit.index') }}" class="btn btn-success mr-2">
                <i class="bi bi-graph-up"></i> View Monthly Profit
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createExpenseModal">
                + Add Expense
            </button>
        </div>
        @include('admin.expenses.modal')
        @include('admin.expenses.edit-modal')
    </div>

    @if($expenses->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $index => $expense)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $expense->category }}</td>
                            <td>₱{{ number_format($expense->amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</td>
                            <td>{{ $expense->description ?? '—' }}</td>
                            <td>
                                <div class="flex justify-even">
                                    <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $expense->id }}"
                                        data-category="{{ $expense->category }}" data-amount="{{ $expense->amount }}"
                                        data-date="{{ $expense->date }}" data-description="{{ $expense->description }}"
                                        data-bs-toggle="modal" data-bs-target="#editExpenseModal">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="ml-2 btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
        </tbody>
    @else
        <div class="alert alert-info text-center mt-4">
            No expense records found.
        </div>
    @endif
</div>