document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('editProductModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        if (!button.classList.contains('edit-btn')) return;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const category = button.getAttribute('data-category');
        const costPrice = button.getAttribute('data-cost-price');
        const sellPrice = button.getAttribute('data-sell-price');
        const stockQty = button.getAttribute('data-stock-qty');
        const barcode = button.getAttribute('data-barcode');
        const image = button.getAttribute('data-image');

        document.getElementById('edit-id').value = id || '';
        document.getElementById('edit-name').value = name || '';
        document.getElementById('edit-category').value = category || '';
        document.getElementById('edit-cost-price').value = costPrice || '';
        document.getElementById('edit-sell-price').value = sellPrice || '';
        document.getElementById('edit-stock-qty').value = stockQty || '';
        document.getElementById('edit-barcode').value = barcode || '';

        const imagePreview = document.getElementById('edit-image-preview');
        const imageElement = document.getElementById('edit-image-src');

        if (image) {
            imageElement.src = image;
            imagePreview.style.display = 'block';
        } else {
            imagePreview.style.display = 'none';
            imageElement.src = '';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const cancelModal = document.getElementById('cancelOrderModal');
    const form = document.getElementById('cancelOrderForm');

    cancelModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const orderId = button.getAttribute('data-order-id');

        // Update form action
        form.action = `/orders/${orderId}/cancel`; // 👈 match your route
    });
});


