document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('input-pesquisa-clientes');
    const tabs = document.querySelectorAll('.tab');
    const tbody = document.querySelector('.admin-table tbody');
    const urlParams = new URLSearchParams(window.location.search);

    let search = urlParams.get('search') || '';
    let sexo = urlParams.get('sexo') || '';
    let filterTimeout;

    if(search) {
        searchInput.focus();
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.value = val;
    }

    tabs.forEach(tab => {
        if(tab.dataset.sexo === sexo) {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        }
    });

    async function applyFilters() {
        const params = new URLSearchParams();
        if(search) params.set('search', search);
        if(sexo) params.set('sexo', sexo);

        const url = '/admin/clientes?' + params.toString();
        window.history.pushState({}, '', url);

        tbody.style.opacity = '0.4';

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const clientes = await response.json();
            
            tbody.innerHTML = '';

            if (clientes.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 2rem;">Nenhum cliente encontrado com estes filtros.</td></tr>';
            } else {
                clientes.forEach(cliente => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td style="font-weight: 600;">${cliente.nome}</td>
                        <td>${cliente.email}</td>
                        <td>${cliente.cpf_formatado}</td>
                        <td>${cliente.telefone_formatado}</td>
                        <td>${cliente.sexo_formatado}</td>
                        <td>${cliente.data_formatada}</td>
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

            sexo = this.dataset.sexo;
            applyFilters();
        });
    });
});