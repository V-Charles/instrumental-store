document.addEventListener('DOMContentLoaded', function() {
    
    const precoInput = document.getElementById('preco');
    const descontoInput = document.getElementById('desconto');
    const precoFinalSpan = document.getElementById('preco-final');

    function formatarMoeda(input) {
        let valor = input.value.replace(/\D/g, '');
        
        if (valor === '') {
            input.value = '';
            calcularPrecoFinal();
            return;
        }

        valor = (parseInt(valor) / 100).toFixed(2) + '';
        valor = valor.replace('.', ',');
        valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        
        input.value = valor;
        calcularPrecoFinal();
    }

    function converterParaNumero(stringMoeda) {
        if (!stringMoeda) return 0;
        let numeroLimpo = stringMoeda.replace(/\./g, '').replace(',', '.');
        return parseFloat(numeroLimpo) || 0;
    }

    function calcularPrecoFinal() {
        if (!precoInput || !descontoInput || !precoFinalSpan) return;
        
        let preco = converterParaNumero(precoInput.value);
        let desconto = converterParaNumero(descontoInput.value);
        
        let final = preco - desconto;
        if (final < 0) final = 0;

        let finalFormatado = final.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        precoFinalSpan.innerText = finalFormatado;
    }

    if (precoInput) {
        precoInput.addEventListener('input', function() {
            formatarMoeda(this);
        });
    }

    if (descontoInput) {
        descontoInput.addEventListener('input', function() {
            formatarMoeda(this);
        });
    }
});