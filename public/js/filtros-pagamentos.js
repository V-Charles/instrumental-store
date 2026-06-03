document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('input-pesquisa-pagamentos');
    const tabs = document.querySelectorAll('.tab');
    const tbody = document.querySelector('.admin-table tbody');
    const urlParams = new URLSearchParams(window.location.search);

    let search = urlParams.get('search') || '';
    let status = urlParams.get('status') || '';
    let filterTimeout;

    if(search) {
        searchInput.focus();
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.value = val;
    }

    tabs.forEach(tab => {
        if(tab.dataset.status === status) {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        }
    });

    async function applyFilters() {
        const params = new URLSearchParams();
        if(search) params.set('search', search);
        if(status) params.set('status', status);

        const url = '/admin/pagamentos?' + params.toString();
        window.history.pushState({}, '', url);

        tbody.style.opacity = '0.4';

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const pagamentos = await response.json();
            
            tbody.innerHTML = '';

            if (pagamentos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 2rem;">Nenhum pagamento encontrado com estes filtros.</td></tr>';
            } else {
                pagamentos.forEach(pagamento => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td style="font-weight: 600;">#${pagamento.cliente_codigo}</td>
                        <td>${pagamento.cliente_nome}</td>
                        <td>${pagamento.data_formatada}</td>
                        <td style="font-weight: 600; color: #b0003a;">R$ ${pagamento.valor_formatado}</td>
                        <td>${pagamento.metodo_texto}</td>
                        <td>
                            <span class="status-badge status-${pagamento.status_classe}">
                                ${pagamento.status_texto}
                            </span>
                        </td>
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

    function scheduleFilter() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(applyFilters, 400);
    }

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            if (search !== e.target.value) {
                search = e.target.value;
                scheduleFilter();
            }
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            status = this.dataset.status;
            applyFilters();
        });
    });
});