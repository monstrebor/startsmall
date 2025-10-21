document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('profitChart');
    if (!canvas) return;

    const labels = JSON.parse(canvas.dataset.labels);
    const sales = JSON.parse(canvas.dataset.sales);
    const expenses = JSON.parse(canvas.dataset.expenses);
    const profit = JSON.parse(canvas.dataset.profit);

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                { label: 'Sales', data: sales, backgroundColor: 'rgba(37,99,235,0.7)', borderRadius: 6 },
                { label: 'Expenses', data: expenses, backgroundColor: 'rgba(239,68,68,0.7)', borderRadius: 6 },
                { label: 'Profit', data: profit, backgroundColor: 'rgba(34,197,94,0.7)', borderRadius: 6 },
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: v => '₱' + v.toLocaleString() }
                }
            }
        }
    });
});
