// Seleciona os elementos do DOM
const productForm = document.getElementById('product-form');
const productTableBody = document.getElementById('product-table').getElementsByTagName('tbody')[0];
const productListItems = document.getElementById('product-list-items');
const decrementQuantityButton = document.getElementById('decrement-quantity');
const incrementQuantityButton = document.getElementById('increment-quantity');
const quantityInput = document.getElementById('product-quantity');

// Função para adicionar um produto à tabela
function addProductToTable(id, category, price, quantity, imageSrc) {
    const newRow = productTableBody.insertRow();

    // Cria células para a nova linha
    const idCell = newRow.insertCell(0);
    const categoryCell = newRow.insertCell(1);
    const priceCell = newRow.insertCell(2);
    const quantityCell = newRow.insertCell(3);
    const imageCell = newRow.insertCell(4);

    // Preenche as células com os dados do produto
    idCell.textContent = id;
    categoryCell.textContent = category;
    priceCell.textContent = `R$ ${parseFloat(price).toFixed(2)}`;
    quantityCell.textContent = quantity;

    // Cria uma imagem do produto
    const img = document.createElement('img');
    img.src = imageSrc;
    img.alt = 'Imagem do Produto';
    img.style.width = '50px'; // Define a largura da imagem
    imageCell.appendChild(img);

    // Adiciona o produto à lista de produtos
    addProductToList(id, category, price, quantity, imageSrc);
}

// Função para adicionar um produto à lista
function addProductToList(id, category, price, quantity, imageSrc) {
    const listItem = document.createElement('li');
    listItem.textContent = `ID: ${id}, Categoria: ${category}, Preço: R$ ${parseFloat(price).toFixed(2)}, Quantidade: ${quantity}`;
    
    // Cria uma imagem do produto na lista
    const img = document.createElement('img');
    img.src = imageSrc;
    img.alt = 'Imagem do Produto';
    img.style.width = '30px'; // Define a largura da imagem na lista
    img.style.marginLeft = '10px'; // Espaçamento à esquerda da imagem
    listItem.appendChild(img);

    // Adiciona o item à lista de produtos
    productListItems.appendChild(listItem);
}

// Manipula o evento de envio do formulário
productForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Captura os valores dos campos do formulário
    const id = document.getElementById('product-id').value;
    const category = document.getElementById('product-category').value;
    const price = document.getElementById('product-price').value;
    const quantity = document.getElementById('product-quantity').value;
    const imageInput = document.getElementById('product-image');

    // Verifica se uma imagem foi selecionada
    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();
        
        // Lê a imagem como URL
        reader.onload = function(e) {
            // Adiciona o produto à tabela com a imagem carregada
            addProductToTable(id, category, price, quantity, e.target.result);
        };

        // Lê o arquivo da imagem
        reader.readAsDataURL(imageInput.files[0]);
    }

    // Limpa o formulário após a adição
    productForm.reset();
});

// Funções para manipular a quantidade
decrementQuantityButton.addEventListener('click', () => {
    const currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
});

incrementQuantityButton.addEventListener('click', () => {
    const currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
});