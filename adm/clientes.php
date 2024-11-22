<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <!--Font Awesome-->
    <link rel="stylesheet" href="public/assets/css/all.css">
    <!--bootstrap css-->
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <!--CSS Style-->
    <link rel="stylesheet" href="public/assets/css/clientes.css">
    <link rel="page" href="index.php">
    <!--Js-->
    <script src="auth.js"></script> <!-- Incluindo o arquivo externo -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../adm/public/assets/js/clientes.js"></script>
</head>
<body>
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
        
    <div class="content">
         <div class="search-bar">
          <input placeholder="Clientes:" type="text"/>
          <button>
           <i class="fas fa-search">
           </i>
          </button>
          <div class="user-info">
           <i class="fas fa-bell notification">
           </i>
          </div>
         </div>
         <div class="panel">
          <div class="client-card">
           <img alt="Foto da Cliente" height="70" width="60"/>
           <div class="client-details">
            <span>
             NOME: 
            </span>
            <br/>
            <span>
             ID: 
            </span>
            <br/>
            <span>
             CPF: 
            </span>
            <br/>
            <span>
             TELEFONE: 
            </span>
            <br/>
            <span>
             ENDEREÇO: 
                </span>
              <br/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>