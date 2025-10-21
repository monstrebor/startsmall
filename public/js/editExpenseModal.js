    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const form = document.getElementById('editExpenseForm');
        const baseUrl = "{{ url('expenses') }}"; 

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const category = button.getAttribute('data-category');
                const amount = button.getAttribute('data-amount');
                const date = button.getAttribute('data-date');
                const description = button.getAttribute('data-description');

                document.getElementById('editExpenseId').value = id;
                document.getElementById('editCategory').value = category;
                document.getElementById('editAmount').value = amount;
                document.getElementById('editDate').value = date;
                document.getElementById('editDescription').value = description || '';

                form.action = `${baseUrl}/${id}`;
            });
        });
    });