@extends('layouts.admin')

@section('breadcrumb', 'ADICIONAR PRODUTO')

@section('content')
<div class="admin-page-header">
    <h2>Adicionar novo produto</h2>
</div>

<form action="/admin/produtos" method="POST" enctype="multipart/form-data" class="product-create-form">
    @csrf
    <div class="form-layout-grid">
        <div class="form-left-column">
            <div class="form-card">
                <h3>Detalhes básicos</h3>
                
                <div class="form-group">
                    <label for="nome">Nome do Produto</label>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Guitarra Stratocaster" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca do Produto</label>
                    <input type="text" id="marca" name="marca" placeholder="Ex: Fender" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição do Produto</label>
                    <textarea id="descricao" name="descricao" rows="5" placeholder="Descreva os detalhes do produto..." required></textarea>
                </div>
            </div>

            <div class="form-card">
                <h3>Precificação</h3>
                
                <div class="form-group">
                    <label for="preco">Preço do produto</label>
                    <div class="input-with-prefix">
                        <span class="prefix">R$</span>
                        <input type="text" id="preco" name="preco" placeholder="0,00" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="desconto">Desconto do produto <span class="optional">(Opcional)</span></label>
                        <div class="input-with-prefix">
                            <span class="prefix">R$</span>
                            <input type="text" id="desconto" name="desconto" placeholder="0,00">
                        </div>
                    </div>
                    <div class="form-group half-width align-bottom">
                        <div class="calculated-price">
                            Vendido = R$ <span id="preco-final">0,00</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="data_inicio">Início da Expiração</label>
                        <input type="date" id="data_inicio" name="data_inicio">
                    </div>
                    <div class="form-group half-width">
                        <label for="data_fim">Fim da Expiração</label>
                        <input type="date" id="data_fim" name="data_fim">
                    </div>
                </div>
            </div>

            <div class="form-card">
                <h3>Inventário</h3>
                
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="quantidade">Quantidade em estoque</label>
                        <input type="number" id="quantidade" name="quantidade" min="0" placeholder="0" required>
                    </div>
                    <div class="form-group half-width">
                        <label for="status">Status de estoque</label>
                        <select id="status" name="status" required>
                            <option value="em_estoque">Em estoque</option>
                            <option value="fora_de_estoque">Fora de estoque</option>
                            <option value="sob_encomenda">Sob encomenda</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-right-column">
            
            <div class="form-card">
                <h3>Upload de Mídias do produto</h3>
                
                <div class="image-upload-area">
                    <input type="file" id="imagem_principal" name="imagem_principal" accept="image/*" required>
                    <div class="upload-placeholder">
                        <span class="material-symbols-outlined">add_photo_alternate</span>
                        <p>Clique ou arraste a mídia principal aqui</p>
                    </div>
                </div>

                <div class="image-thumbnails">
                    <div class="thumbnail-box dotted-box" style="width: 120px;">
                        <input type="file" id="imagens_extras" name="imagens_extras[]" accept="image/*" multiple>
                        <span class="material-symbols-outlined">library_add</span>
                        <span>Add imagens</span>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <h3>Categorias</h3>
                
                <div class="form-group">
                    <label for="categoria">Categoria do produto</label>
                    <select id="categoria" name="categoria" required>
                        <option value="" disabled selected>selecione seu produto</option>
                        <option value="acessorios">Acessórios</option>
                        <option value="cordas">Cordas</option>
                        <option value="amplificadores">Amplificadores</option>
                        <option value="pedais">Pedais & Pedaleiras</option>
                        <option value="percussao">Percussão</option>
                        <option value="audio">Áudio e Tecnologia</option>
                        <option value="sopro">Sopro</option>
                        <option value="teclas">Teclas</option>
                    </select>
                </div>
            </div>

            <div class="form-card">
                <h3>Selecionar cor</h3>
                
                <div class="color-picker-group">
                    <input type="checkbox" id="cor_verde" name="cores[]" value="verde">
                    <label for="cor_verde" class="color-swatch" style="background-color: #dcedc8;"></label>

                    <input type="checkbox" id="cor_rosa" name="cores[]" value="rosa">
                    <label for="cor_rosa" class="color-swatch" style="background-color: #f8bbd0;"></label>

                    <input type="checkbox" id="cor_azul" name="cores[]" value="azul">
                    <label for="cor_azul" class="color-swatch" style="background-color: #cfd8dc;"></label>

                    <input type="checkbox" id="cor_amarelo" name="cores[]" value="amarelo">
                    <label for="cor_amarelo" class="color-swatch" style="background-color: #f0f4c3;"></label>

                    <input type="checkbox" id="cor_preto" name="cores[]" value="preto">
                    <label for="cor_preto" class="color-swatch" style="background-color: #37474f;"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions-footer">
        <a href="/admin/produtos" class="btn-cancel">Cancelar</a>
        <button type="submit" class="btn-save">Salvar</button>
    </div>
</form>
@endsection