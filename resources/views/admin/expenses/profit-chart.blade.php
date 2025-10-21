<div class="mt-10">
    <h3 class="text-lg font-semibold text-gray-700 mb-3">📊 Profit Overview</h3>
    <canvas id="profitChart" height="120"></canvas>
</div>

@php
    $labels = $profitData->pluck('month')->map(fn($m) => \Carbon\Carbon::createFromFormat('Y-m', $m)->format('M Y'));
    $sales = $profitData->pluck('total_sales');
    $expenses = $profitData->pluck('total_expenses');
    $profit = $profitData->pluck('profit');
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('profitChart');
        if (!canvas) return;

        const labels = @json($labels);
        const sales = @json($sales);
        const expenses = @json($expenses);
        const profit = @json($profit);

        const ctx = canvas.getContext('2d');

        const gradientSales = ctx.createLinearGradient(0, 0, 0, 300);
        gradientSales.addColorStop(0, 'rgba(37,99,235,0.6)');
        gradientSales.addColorStop(1, 'rgba(37,99,235,0.1)');

        const gradientExpenses = ctx.createLinearGradient(0, 0, 0, 300);
        gradientExpenses.addColorStop(0, 'rgba(239,68,68,0.6)');
        gradientExpenses.addColorStop(1, 'rgba(239,68,68,0.1)');

        const gradientProfit = ctx.createLinearGradient(0, 0, 0, 300);
        gradientProfit.addColorStop(0, 'rgba(34,197,94,0.6)');
        gradientProfit.addColorStop(1, 'rgba(34,197,94,0.1)');

        new Chart(ctx, {
            data: {
                labels,
                datasets: [
                    {
                        type: 'bar',
                        label: 'Sales',
                        data: sales,
                        backgroundColor: gradientSales, 
                        borderRadius: 6
                    },
                    {
                        type: 'bar',
                        label: 'Expenses',
                        data: expenses,
                        backgroundColor: gradientExpenses, 
                        borderRadius: 6
                    },
                    {
                        type: 'line',
                        label: 'Profit',
                        data: profit,
                        borderColor: 'rgba(34,197,94,1)',
                        backgroundColor: gradientProfit,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 5,
                        fill: true, 
                        yAxisID: 'y'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: ctx => '₱' + ctx.parsed.y.toLocaleString()
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: v => '₱' + v.toLocaleString() },
                        grid: { color: '#eee' }
                    },
                    x: { grid: { color: '#eee' } }
                }
            }
        });
    });
</script>