<!--php-->
<?php
include("conn.php");

?>


 <!--html-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anúncios</title>
        <!--Font Awesome-->
        <link rel="stylesheet" href="public/assets/css/all.css">
        <!--bootstrap css-->
        <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
        <!--CSS Style-->
        <link rel="stylesheet" href="public/assets/css/anuncios.css">
        <!--JS-->
        <script src="auth.js"></script> <!-- Incluindo o arquivo externo -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
        <script src="../adm/public/assets/js/anuncios.js"></script>
        <link rel="page" href="index.php">
</head>
<body>
    <script>
        let uploadedImages = [];

        // Função para lidar com o clique do botão Adicionar
        function handleAddClick() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(event) {
                const file = event.target.files[0];
                if (file && !uploadedImages.includes(file.name)) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        const wrapper = document.createElement('div');
                        wrapper.className = 'image-wrapper';
                        wrapper.onclick = function() {
                            wrapper.classList.toggle('selected');
                        };
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.className = 'checkbox';
                        const info = document.createElement('div');
                        info.className = 'image-info';
                        info.innerHTML = `
                            <div>Categoria: <span class="category">N/A</span></div>
                            <div>Data: ${new Date().toLocaleDateString()}</div>
                            <div>Nome: ${file.name}</div>
                        `;
                        wrapper.appendChild(img);
                        wrapper.appendChild(checkbox);
                        wrapper.appendChild(info);
                        document.querySelector('.image-container').appendChild(wrapper);
                        document.querySelector('.dropdown-menu').classList.add('show');
                        uploadedImages.push(file.name);
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Esta imagem já foi carregada.');
                }
            };
            input.click();
        }

        // Função para lidar com o clique do botão Excluir
        function handleDeleteClick() {
            const selectedImages = document.querySelectorAll('.image-wrapper.selected');
            selectedImages.forEach(imageWrapper => {
                const imgSrc = imageWrapper.querySelector('img').src;
                const imgName = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);
                uploadedImages = uploadedImages.filter(name => name !== imgName);
                imageWrapper.remove();
            });
        }

        // Função para lidar com a seleção de categoria
        function handleCategoryClick(category) {
            const selectedImages = document.querySelectorAll('.image-wrapper.selected');
            selectedImages.forEach(imageWrapper => {
                const categorySpan = imageWrapper.querySelector('.category');
                categorySpan.textContent = category;
            });
        }
    </script>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar d-flex flex-column">
            <div class="logo">
                <i class="fas fa-heart"></i>
                <span>Nay Acessório</span>
            </div>
            <a href="index.php">
                <i class="fas fa-house"></i>
                Home
            </a>
            <a href="estoque.php">
                <i class="fas fa-box"></i>
                Estoque
            </a>
            <a href="financas.php">
                <i class="fas fa-dollar-sign"></i>
                Finanças
            </a>
            <a href="clientes.php">
                <i class="fas fa-users"></i>
                Clientes
            </a>
            <a href="anuncios.php">
                <i class="fas fa-bullhorn"></i>
                Anúncios
            </a>
            <a class="active" href="ad_produtos.php">
                <i class="fas fa-plus"></i>
                Ad. Produtos
            </a>
            <a href="prod_adicionados.php">
                <i class="fas fa-check"></i>
                Prod. Adicionados
            </a>
            <a href="pedidos.php">
                <i class="fas fa-shopping-cart"></i>
                Pedidos
            </a>
            <div class="spacer"></div>
            <a href="#" onclick="logout()" style="text-decoration: none;">
                <i class="fas fa-sign-out-alt"></i>
                Sair
            </a>
        </div>
        <!-- Conteúdo Principal -->
        <div class="content">
            <!-- Header -->
            <div class="header">
                <span class="title">Anúncios</span>
                <div class="icons">
                    <i class="fas fa-bell">
                        <span class="badge">1</span>
                    </i>
                </div>
            </div>
            <!-- Área de Conteúdo Principal -->
            <div class="main-content">
                <div class="image-container"></div>
            </div>
            <!-- Botões na parte inferior -->
            <div class="buttons">
                <button class="btn btn-add" onclick="handleAddClick()">+ Adicionar</button>
                <button class="btn btn-delete" onclick="handleDeleteClick()">Excluir</button>
                <div class="btn-categories">
                    <button class="btn" onclick="document.querySelector('.dropdown-menu').classList.toggle('show')">Categoria</button>
                    <div class="dropdown-menu">
                        <a href="#" onclick="handleCategoryClick('Carrossel')">Carrossel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>