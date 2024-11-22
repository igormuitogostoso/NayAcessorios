<?php
include("conn.php");

// Verificação de dados recebidos
$cod_prod = NULL;
$prod_preco = $_POST["prod_preco"];
$prod_quant = $_POST["prod_quant"];  // Quantidade em estoque
$prod_desc = $_POST["prod_desc"];
$prod_nome = $_POST["prod_nome"];
$tamanho_prod = $_POST["tamanho_prod"];
$categoria_prod = $_POST["categoria_prod"];
$avatar = $_FILES["imagemProduto"]["name"]; // Nome do arquivo de imagem

// Verifica se o arquivo de imagem foi carregado
if (!empty($_FILES["imagemProduto"]["tmp_name"])) {
    $pasta = "public/assets/images/"; // Pasta onde as imagens serão armazenadas
    $target_file = $pasta . basename($avatar);
    move_uploaded_file($_FILES["imagemProduto"]["tmp_name"], $target_file);
}

// Preparar a consulta para verificar se o produto já existe
$query = $mysqli->prepare("SELECT * FROM produto WHERE cod_prod = ?");
$query->bind_param("s", $cod_prod);
$query->execute();
$result = $query->get_result();
$check = $result->num_rows;

if ($check >= 1) {
    // Se o produto já existir, redireciona para a página de adição de produtos
    header("Location: ./adm/ad_produtos.php");
    exit();
} else {
    // Caso o produto não exista, insere os dados no banco, incluindo a quantidade em estoque
    $insert_query = $mysqli->prepare("INSERT INTO produto (cod_prod, prod_preco, prod_quanti, prod_desc, prod_nome, tamanho_prod, categoria_prod, imagem_produto) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_query->bind_param("ssssssss", $cod_prod, $prod_preco, $prod_quant, $prod_desc, $prod_nome, $tamanho_prod, $categoria_prod, $avatar);
    $insert_query->execute();
    
    // Redireciona para a página de produtos adicionados
    header("Location: ./adm/prod_adicionados.php");
    exit();
}

// Caso não haja o código do produto, faz a inserção com menos campos
$insert_query_2 = $mysqli->prepare("INSERT INTO produto (prod_quant, prod_nome, imagem) VALUES (?, ?, ?)");
$insert_query_2->bind_param("sss", $prod_quant, $prod_nome, $avatar);
$insert_query_2->execute();

// Redireciona para a página de estoque
header("Location: ./adm/estoque.php");
exit();
?>
