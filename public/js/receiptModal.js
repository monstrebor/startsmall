document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('receiptModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

        const receiptId = btn?.getAttribute('data-sale-id') || '—';
        const cashier = btn?.getAttribute('data-cashier') || '—';
        const date = btn?.getAttribute('data-date') || '—';
        const payment = btn?.getAttribute('data-payment') || '—';
        const total = btn?.getAttribute('data-total') || '₱0.00';
        const tin = btn?.getAttribute('data-tin') || '—';
        const receipt = btn?.getAttribute('data-receipt') || '—';
        const itemsJson = btn?.getAttribute('data-items') || '[]';

        document.getElementById('modalReceiptId').textContent = receiptId;
        document.getElementById('modalCashier').textContent = cashier;
        document.getElementById('modalDate').textContent = date;
        document.getElementById('modalPayment').textContent = payment;
        document.getElementById('modalTotal').textContent = total;
        document.getElementById('modalTIN').textContent = tin;
        document.getElementById('modalReceiptNo').textContent = receipt;

        const itemsBody = document.getElementById('modalItems');
        itemsBody.innerHTML = '';

        let items = [];
        try {
            items = JSON.parse(itemsJson);
        } catch (e) {
            console.error('Failed to parse items JSON', e);
        }

        if (!items.length) {
            itemsBody.innerHTML = `<tr><td colspan="4" style="text-align:center;color:#666;">No items data</td></tr>`;
        } else {
            items.forEach(i => {
                itemsBody.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td style="text-align:left;">${escapeHtml(i.product)}</td>
                        <td style="text-align:center;">${escapeHtml(i.qty)}</td>
                        <td style="text-align:right;">₱${escapeHtml(i.price)}</td>
                        <td style="text-align:right;">₱${escapeHtml(i.total)}</td>
                    </tr>
                `);
            });
        }

    });

    document.getElementById('printReceiptBtn').addEventListener('click', function () {
        const content = document.getElementById('receiptContent').innerHTML;
        const w = window.open('', '', 'width=420,height=700');
        w.document.write(`
            <html>
                <head>
                    <title>Receipt</title>
                    <style>
                        body { font-family: 'Courier New', monospace; font-size:13px; padding:10px; }
                        table { width:100%; border-collapse: collapse; }
                        th, td { padding:4px 6px; }
                        thead th { font-weight:700; }
                        hr { border-top:1px dashed #bbb; }
                        .text-right { text-align:right; }
                    </style>
                </head>
                <body>${content}</body>
            </html>
        `);
        w.document.close();
        w.focus();
        setTimeout(() => { w.print(); w.close(); }, 300);
    });

    document.getElementById('pdfReceiptBtn').addEventListener('click', function () {
        const node = document.getElementById('receiptContent');
        const receiptId = document.getElementById('modalReceiptId').textContent || 'receipt';
        const opt = {
            margin: [0.2, 0.2, 0.2, 0.2],
            filename: `receipt-${receiptId}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(node).save();
    });

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
});
