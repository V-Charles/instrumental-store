document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('input-pesquisa');
    const categoryCards = document.querySelectorAll('.category-card');
    const tabs = document.querySelectorAll('.tab');
    const tbody = document.querySelector('.admin-table tbody');
    const urlParams = new URLSearchParams(window.location.search);

    let search = urlParams.get('search') || '';
    let categorias = urlParams.getAll('categorias[]');
    let status = urlParams.get('status') || '';
    let filterTimeout;

    if(search) {
        searchInput.focus();
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.value = val;
    }

    categoryCards.forEach(card => {
        if(categorias.includes(card.dataset.value)) {
            card.classList.add('active');
        }
    });

    async function applyFilters() {
        const params = new URLSearchParams();
        if(search) params.set('search', search);
        if(status) params.set('status', status);
        categorias.forEach(cat => params.append('categorias[]', cat));

        const url = '/admin/produtos?' + params.toString();
        window.history.pushState({}, '', url);

        tbody.style.opacity = '0.4';

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const produtos = await response.json();
            
            tbody.innerHTML = '';

            if (produtos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; padding: 2rem;">Nenhum produto encontrado com estes filtros.</td></tr>';
            } else {
                produtos.forEach(produto => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${produto.id}</td>
                        <td>${produto.nome}</td>
                        <td>${produto.data_criacao_formatada}</td>
                        <td>0</td>
                        <td>
                            <div class="action-buttons">
                                <a href="/admin/produtos/${produto.id}/edit"><span class="material-symbols-outlined">edit</span></a>
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

    searchInput.addEventListener('input', function(e) {
        if (search !== e.target.value) {
            search = e.target.value;
            scheduleFilter();
        }
    });

    categoryCards.forEach(card => {
        card.addEventListener('click', function() {
            const catValue = this.dataset.value;
            
            if(categorias.includes(catValue)) {
                categorias = categorias.filter(c => c !== catValue);
                this.classList.remove('active');
            } else {
                categorias.push(catValue);
                this.classList.add('active');
            }

            this.blur();
            
            scheduleFilter();
        });
    });

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabStatus = this.dataset.status;
            if (tabStatus === 'destaque') return;

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            status = tabStatus;
            applyFilters();
        });
    });
});