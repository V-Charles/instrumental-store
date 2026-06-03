document.addEventListener('DOMContentLoaded', function() {
    
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(176, 0, 58, 0.2)');
    gradient.addColorStop(1, 'rgba(176, 0, 58, 0)');

    let dashboardChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Receita',
                data: dadosSemanaAtual,
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
                legend: { display: false },
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
                x: { grid: { display: false, drawBorder: false }, ticks: { color: '#888', font: { size: 12 } } },
                y: {
                    grid: { color: '#f0f0f0', drawBorder: false, borderDash: [5, 5] },
                    ticks: {
                        color: '#888', font: { size: 12 },
                        callback: function(value) { return value >= 1000 ? (value / 1000) + 'k' : value; }
                    },
                    beginAtZero: true
                }
            }
        }
    });

    const btnSemanaAtual = document.getElementById('btn-semana-atual');
    const btnSemanaAnterior = document.getElementById('btn-semana-anterior');

    btnSemanaAtual.addEventListener('click', function() {
        btnSemanaAtual.style.color = '#b0003a';
        btnSemanaAnterior.style.color = '#888';
        dashboardChart.data.datasets[0].data = dadosSemanaAtual;
        dashboardChart.update();
    });

    btnSemanaAnterior.addEventListener('click', function() {
        btnSemanaAnterior.style.color = '#b0003a';
        btnSemanaAtual.style.color = '#888';
        dashboardChart.data.datasets[0].data = dadosSemanaAnterior;
        dashboardChart.update();
    });

    const searchInput = document.getElementById('input-pesquisa-dash');
    const tabs = document.querySelectorAll('.tab-dash');
    const tbody = document.getElementById('tbody-pedidos-dash');

    let search = '';
    let status = '';
    let filterTimeout;

    async function applyFilters() {
        tbody.style.opacity = '0.4';
        const params = new URLSearchParams();
        if(search) params.set('search', search);
        if(status) params.set('status', status);

        const url = '/admin/dashboard?' + params.toString();

        try {
            const response = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            const pedidos = await response.json();
            tbody.innerHTML = '';

            if (pedidos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 2rem;">Nenhum pedido encontrado.</td></tr>';
            } else {
                pedidos.forEach((pedido, index) => {
                    const dotClass = pedido.status_pagamento === 'pago' ? 'dot-pago' : 'dot-nao-pago';
                    const dotText = pedido.status_pagamento === 'pago' ? 'Pago' : 'Não pago';
                    
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td style="font-weight: 600;">#${pedido.codigo}</td>
                        <td>${pedido.data_formatada}</td>
                        <td style="font-weight: 600;">R$ ${pedido.valor_formatado}</td>
                        <td><span class="status-dot ${dotClass}"></span> ${dotText}</td>
                        <td><span class="status-badge status-${pedido.status_classe}">${pedido.status_texto}</span></td>
                    `;
                    tbody.appendChild(tr);
                });
            }
        } catch (error) {
            console.error(error);
        } finally {
            tbody.style.opacity = '1';
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            search = e.target.value;
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(applyFilters, 400);
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => {
                t.style.color = '#888';
                t.classList.remove('active');
            });
            this.style.color = '#b0003a';
            this.classList.add('active');
            status = this.dataset.status;
            applyFilters();
        });
    });
});