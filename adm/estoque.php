<?php
include("conn.php"); // Inclui o arquivo de conexão com o banco

// Definindo as credenciais de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loja";

// Criando a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL para buscar os produtos
$sql = "SELECT prod_nome, imagem_produto, prod_quanti FROM produto"; // Corrigido o SQL (removido a vírgula extra)
$result = $conn->query($sql);

$products = array();

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Adiciona cada produto ao array
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <!--Font Awesome-->
    <link rel="stylesheet" href="public/assets/css/all.css">
    <!--bootstrap css-->
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <!--CSS Style-->
    <link rel="stylesheet" href="public/assets/css/estoque.css">
    <link rel="page" href="index.php">
    <!--Js-->
    <script src="auth.js"></script> <!-- Incluindo o arquivo externo -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../adm/public/assets/js/estoque.js"></script>
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
        
        <div class="items" id="aneis">
            <div class="item">
                <img alt="Anel" height="100" width="100"/>
                <div>
                    Anel
                </div>
                <div class="quantity">
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity('Anel', -1)">
                        -
                    </button>
                    <span id="Anel-quantity">
                        1
                    </span>
                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity('Anel', 1)">
                        +
                    </button>
                </div>
            </div>
        </div>
        <!-- (Outros produtos aqui) -->

        <button id="saveButton" class="btn btn-primary" onclick="saveAll()">Salvar</button>
    </div>

    <script>
        let hasUnsavedChanges = false;

        function updateQuantity(produto, change) {
            var quantityElement = document.getElementById(produto + '-quantity');
            var currentQuantity = parseInt(quantityElement.innerText);
            var newQuantity = currentQuantity + change;
            if (newQuantity >= 0) {
                quantityElement.innerText = newQuantity;
                hasUnsavedChanges = true; // Marca que houve alteração
                saveProduct(produto, newQuantity);
            }
        }

        function saveProduct(produto, quantity) {
            var formData = new FormData();
            formData.append('prod_nome', produto);
            formData.append('prod_quant', quantity);

            fetch('salvar_produto.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                hasUnsavedChanges = false; // Reseta a flag após salvar
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function saveAll() {
            // Aqui você pode implementar a lógica para salvar todos os produtos
            // Por enquanto, apenas reseta a flag
            hasUnsavedChanges = false;
            alert("Todas as alterações foram salvas!");
        }

        window.onbeforeunload = function() {
            if (hasUnsavedChanges) {
                return "Você tem alterações não salvas. Tem certeza que deseja sair?";
            }
        };

        function showCategory(category) {
            var categories = ['aneis', 'brincos', 'braceletes', 'colares', 'tornozeleiras'];
            categories.forEach(function(cat) {
                document.getElementById(cat).style.display = 'none';
            });
            document.getElementById(category).style.display = 'flex';
        }
    </script>
</body>
</html>