document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('dashboardChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(176, 0, 58, 0.2)');
    gradient.addColorStop(1, 'rgba(176, 0, 58, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Receita',
                data: chartData,
                borderColor: '#b0003a',
                backgroundColor: gradient,
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#b0003a',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#b0003a',
                    borderColor: '#eaeaea',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            let value = context.raw || 0;
                            return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#888',
                        font: {
                            size: 12
                        }
                    }
                },
                y: {
                    grid: {
                        color: '#f0f0f0',
                        drawBorder: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        color: '#888',
                        font: {
                            size: 12
                        },
                        callback: function(value) {
                            if (value >= 1000) {
                                return (value / 1000) + 'k';
                            }
                            return value;
                        }
                    },
                    beginAtZero: true
                }
            }
        }
    });
});