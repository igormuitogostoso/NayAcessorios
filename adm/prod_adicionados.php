<?php

// Inclui o arquivo de conexão com o banco de dados (certifique-se que o conn.php faz a conexão)
include("conn.php"); // Se você já estiver criando a conexão no conn.php, remova a duplicação abaixo

// Definindo as variáveis de conexão com o banco de dados (isso pode ser desnecessário se já estiver em conn.php)
$servername = "localhost"; // Nome do servidor
$username = "root";        // Nome de usuário do banco de dados
$password = "";            // Senha do banco de dados
$dbname = "loja";          // Nome do banco de dados

// Cria a conexão com o banco de dados (remova se já estiver em conn.php)
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error); // Exibe mensagem de erro e encerra o script se a conexão falhar
}

// Consulta SQL para buscar todos os produtos da tabela 'produto'
$sql = "SELECT cod_prod, prod_preco, categoria_prod, prod_nome, prod_quanti, tamanho_prod, prod_desc, imagem_produto FROM produto";
$result = $conn->query($sql); // Executa a consulta SQL

// Verifica se há resultados retornados pela consulta
if ($result->num_rows > 0) {
    // Itera sobre os resultados e exibe cada produto
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img src="' . htmlspecialchars($row["imagem_produto"]) . '" alt="Imagem do produto" width="150" height="150">';
        echo '<div class="product-details">';
        echo '<div><strong>ID: </strong>' . htmlspecialchars($row["cod_prod"]) . '</div>';
        echo '<div><strong>Preço (R$): </strong>' . htmlspecialchars($row["prod_preco"]) . '</div>';
        echo '<div><strong>Categoria: </strong>' . htmlspecialchars($row["categoria_prod"]) . '</div>';
        echo '</div>';
        echo '<div class="product-details">';
        echo '<div><strong>Nome: </strong>' . htmlspecialchars($row["prod_nome"]) . '</div>';
        echo '<div><strong>Unidade: </strong>' . htmlspecialchars($row["prod_quanti"]) . '</div>';
        echo '<div><strong>Tamanho: </strong>' . htmlspecialchars($row["tamanho_prod"]) . '</div>';
        echo '</div>';
        echo '<div class="product-details">';
        echo '<div><strong>Descrição: </strong>' . htmlspecialchars($row["prod_desc"]) . '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Nenhum produto adicionado.";
}

// Fecha a conexão com o banco de dados
$conn->close();

?>


        </div>
    </div>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Adicionados</title>
      <!-- Font Awesome para ícones -->
      <link rel="stylesheet" href="public/assets/css/all.css">
      <!-- Bootstrap CSS para estilos -->
      <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
      <!-- CSS personalizado para a página -->
      <link rel="stylesheet" href="public/assets/css/prod_adicionados.css">
      <link rel="page" href="index.php"> <!-- Link para a página inicial -->
      <!-- JavaScript -->
      <script src="auth.js"></script> <!-- Incluindo o arquivo de autenticação -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script> <!-- Incluindo Bootstrap JS -->
      <script src="../adm/public/assets/js/prod_adicionados.js"></script> <!-- Incluindo script personalizado -->
</head>
<body>
<body>
    <div class="d-flex"> <!-- Usando flexbox para layout -->
        <div class="sidebar d-flex flex-column"> <!-- Sidebar de navegação -->
            <div class="logo ">
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
        
        <div class="content">
         <div class="product-header">
          <h5>
           Produtos Adicionados
          </h5>
          <i class="fas fa-bell icon">
          </i>
         </div>
         <div class="product-card">
          <img alt="Placeholder image for product" height="50" src="https://storage.googleapis.com/a1aa/image/noJf85wTeYjMlUzvEax8FuQ5rn5vkczWa2bPTRdtL01WHlyTA.jpg" width="50"/>
          <div class="product-details">
           <div>
            <strong>
             ID
            </strong>
           </div>
           <div>
            <strong>
             Preço (R$):
            </strong>
           </div>
           <div>
            <strong>
             Categoria
            </strong>
           </div>
          </div>
          <div class="product-details">
           <div>
            <strong>
             Nome:
            </strong>
           </div>
           <div>
            <strong>
             Unidade
            </strong>
           </div>
           <div>
            <strong>
             Tamanho
            </strong>
           </div>
          </div>
          <div class="product-details">
           <div>
            <strong>
             Descrição
            </strong>
           </div>
          </div>
         </div>
        </div>
       </div>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js">
       </script>
      </body>
</body>
</html>