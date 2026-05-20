document.addEventListener('DOMContentLoaded', function() {
    
    const imagemPrincipal = document.getElementById('imagem_principal');
    if (imagemPrincipal) {
        imagemPrincipal.addEventListener('change', function(e) {
            const area = this.nextElementSibling;
            if (e.target.files.length > 0) {
                const src = URL.createObjectURL(e.target.files[0]);
                area.innerHTML = `<img src="${src}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">`;
            }
        });
    }

    const inputExtras = document.getElementById('imagens_extras');
    if (inputExtras) {
        const containerPai = document.querySelector('.image-thumbnails');
        const botaoAdd = inputExtras.parentElement; 
        
        let arquivosAcumulados = [];

        function atualizarInputFiles() {
            const dataTransfer = new DataTransfer();
            arquivosAcumulados.forEach(file => dataTransfer.items.add(file));
            inputExtras.files = dataTransfer.files;
        }

        inputExtras.addEventListener('change', function(e) {
            const novosArquivos = Array.from(e.target.files);
            let limiteExcedido = false;

            novosArquivos.forEach(file => {
                if (arquivosAcumulados.length < 4) {
                    arquivosAcumulados.push(file);
                    atualizarInputFiles();
                    
                    const src = URL.createObjectURL(file);
                    const box = document.createElement('div');
                    box.className = 'thumbnail-box';
                    box.style.border = 'none'; 
                    
                    box.innerHTML = `
                        <img src="${src}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                        <button type="button" class="remove-image-btn" title="Remover imagem">
                            <span class="material-symbols-outlined" style="font-size: 16px;">close</span>
                        </button>
                    `;
                    
                    box.querySelector('.remove-image-btn').addEventListener('click', function() {
                        const index = arquivosAcumulados.indexOf(file);
                        if (index > -1) {
                            arquivosAcumulados.splice(index, 1);
                            atualizarInputFiles();
                        }
                        box.remove();

                        if (arquivosAcumulados.length < 4) {
                            botaoAdd.style.display = 'flex';
                        }
                    });

                    containerPai.insertBefore(box, botaoAdd);
                } else {
                    limiteExcedido = true;
                }
            });

            if (limiteExcedido) {
                alert('Você atingiu o limite máximo de 4 imagens extras.');
            }

            if (arquivosAcumulados.length >= 4) {
                botaoAdd.style.display = 'none';
            }
        });
    }
});