document.addEventListener('DOMContentLoaded', function () {
    const addProductBtn = document.getElementById('addProductRow');
    const productList = document.getElementById('product-list');
    const totalDisplay = document.getElementById('totalDisplay');

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(el => {
            total += parseFloat(el.value || 0);
        });
        totalDisplay.textContent = '₱' + total.toFixed(2);
    }

    function addProductRow() {
        const row = document.createElement('div');
        row.classList.add('grid', 'grid-cols-5', 'items-center', 'gap-2');

        const optionsHTML = document.getElementById('product-options-template').innerHTML;

        row.innerHTML = `
            <div>
                <select name="product_id[]" class="form-select w-full">
                    ${optionsHTML}
                </select>
            </div>
            <div>
                <input type="number" name="qty[]" class="form-control w-full qty" min="1" value="1">
            </div>
            <div>
                <input type="text" name="price[]" class="form-control w-full price" readonly>
            </div>
            <div>
                <input type="text" name="subtotal[]" class="form-control w-full subtotal" readonly>
            </div>
            <div class="flex justify-center">
                <button type="button" class="text-red-600 hover:text-red-800 remove-row text-xl font-bold">×</button>
            </div>
        `;

        productList.appendChild(row);

        const productSelect = row.querySelector('select');
        const qtyInput = row.querySelector('.qty');
        const priceInput = row.querySelector('.price');
        const subtotalInput = row.querySelector('.subtotal');

        function updateSubtotal() {
            const qty = parseFloat(qtyInput.value || 0);
            const price = parseFloat(priceInput.value || 0);
            subtotalInput.value = (qty * price).toFixed(2);
            updateTotal();
        }

        productSelect.addEventListener('change', function () {
            const price = this.options[this.selectedIndex].dataset.price || 0;
            priceInput.value = parseFloat(price).toFixed(2);
            updateSubtotal();
        });

        qtyInput.addEventListener('input', updateSubtotal);

        row.querySelector('.remove-row').addEventListener('click', () => {
            row.remove();
            updateTotal();
        });
    }

    addProductBtn.addEventListener('click', addProductRow);
});