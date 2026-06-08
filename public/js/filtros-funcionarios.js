document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('input-pesquisa-funcionarios');
    const tabs = document.querySelectorAll('.tab');
    const tbody = document.querySelector('.admin-table tbody');
    const urlParams = new URLSearchParams(window.location.search);

    let search = urlParams.get('search') || '';
    let cargo = urlParams.get('cargo') || '';
    let filterTimeout;

    if(search) {
        searchInput.focus();
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.value = val;
    }

    tabs.forEach(tab => {
        if(tab.dataset.cargo === cargo) {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        }
    });

    async function applyFilters() {
        const params = new URLSearchParams();
        if(search) params.set('search', search);
        if(cargo) params.set('cargo', cargo);

        const url = '/admin/funcionarios?' + params.toString();
        window.history.pushState({}, '', url);

        tbody.style.opacity = '0.4';

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const funcionarios = await response.json();
            
            tbody.innerHTML = '';

            if (funcionarios.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; padding: 2rem;">Nenhum funcionário encontrado.</td></tr>';
            } else {
                funcionarios.forEach(funcionario => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td style="font-weight: 600;">${funcionario.name}</td>
                        <td>${funcionario.email}</td>
                        <td>${funcionario.cargo_formatado}</td>
                        <td>
                            <span class="status-badge status-${funcionario.status_classe}">
                                ${funcionario.status_texto}
                            </span>
                        </td>
                        <td>${funcionario.data_formatada}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="/admin/funcionarios/${funcionario.id}/editar" title="Editar"><span class="material-symbols-outlined">edit</span></a>
                            </div>
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

            cargo = this.dataset.cargo;
            applyFilters();
        });
    });
});