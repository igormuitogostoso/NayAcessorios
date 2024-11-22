<?php
include("conn.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finanças</title>
    <!--Font Awesome-->
    <link rel="stylesheet" href="public/assets/css/all.css">
    <!--bootstrap css-->
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <!--CSS Style-->
    <link rel="stylesheet" href="public/assets/css/finanças.css">
    <link rel="page" href="index.php">
    <!--Js-->
    <script src="auth.js"></script> <!-- Incluindo o arquivo externo -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="../adm/public/assets/js/financas.js"></script>
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
        
        <div class="content flex-grow-1">
            <div class="header">
                <h1>Finanças</h1>
                <div class="icons">
                    <i class="fas fa-bell" style="font-size: 24px;"></i> <!-- Aumentado -->
                     <i class="fas fa-user-circle" style="display: none;"></i>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card first-card">
                        <h2>Lucro</h2>
                        <form id="profitForm">
                            <div class="form-group">
                                <label for="revenue" class="form-label">Receita</label>
                                <input type="text" class="form-control currency" id="revenue" value="R$ 00,00" required>
                            </div>
                            <div class="form-group">
                                <label for="expenses" class="form-label">Despesas</label>
                                <input type="text" class="form-control currency" id="expenses" value="R$ 00,00" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular Lucro</button>
                        </form>
                        <h3 id="profitResult">Lucro: R$ 0.00</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h2>Saldo Disponível</h2>
                        <form id="balanceForm">
                            <div class="mb-3">
                                <label for="initialBalance" class="form-label">Saldo Inicial</label>
                                <input type="text" class="form-control currency" id="initialBalance" value="R$ 00,00" required>
                            </div>
                            <div class="mb-3">
                                <label for="income" class="form-label">Renda</label>
                                <input type="text" class="form-control currency" id="income" value="R$ 00,00" required>
                            </div>
                            <div class="mb-3">
                                <label for="outgoing" class="form-label">Saídas</label>
                                <input type="text" class="form-control currency" id="outgoing" value="R$ 00,00" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular Saldo</button>
                        </form>
                        <h3 id="balanceResult">Saldo Disponível: R$ 0.00</h3>
                  </div>
                </div>
                <div class="col-12">
                    <div class="card mt-4">
                        <h2>Despesas Fixas</h2>
                        <form id="fixedExpensesForm">
                            <div class="mb-3">
                                <label for="rent" class="form-label">Aluguel</label>
                                <input type="text" class="form-control currency" id="rent" value="R$ 00,00" required>
                            </div>
                            <div class="mb-3">
                                <label for="utilities" class="form-label">Utilidades</label>
                                <input type="text" class="form-control currency" id="utilities" value="R$ 00,00" required>
                            </div>
                            <div class="mb-3">
                                <label for="salaries" class="form-label">Salários</label>
                                <input type="text" class="form-control currency" id="salaries" value="R$ 00,00" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular Despesas</button>
                        </form>
                        <h3 id="fixedExpensesResult">Despesas Fixas: R$ 0.00</h3>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let profitData = {};
        let balanceData = {};
        let fixedExpensesData = {};

        document.querySelectorAll('.currency').forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = (value / 100).toFixed(2);
                e.target.value = `R$ ${value.replace('.', ',')}`;
            });

            input.addEventListener('keydown', function(e) {
                if (e.key.length === 1 && !/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });
        });

        document.getElementById('profitForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const revenue = parseFloat(document.getElementById('revenue').value.replace('R$', '').replace(',', '.'));
            const expenses = parseFloat(document.getElementById('expenses').value.replace('R$', '').replace(',', '.'));
            const profit = revenue - expenses;
            document.getElementById('profitResult').innerText = `Lucro: R$ ${profit.toFixed(2).replace('.', ',')}`;
            profitData = { Receita: revenue, Despesas: expenses, Lucro: profit.toFixed(2) };
        });

        document.getElementById('balanceForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const initialBalance = parseFloat(document.getElementById('initialBalance').value.replace('R$', '').replace(',', '.'));
            const income = parseFloat(document.getElementById('income').value.replace('R$', '').replace(',', '.'));
            const outgoing = parseFloat(document.getElementById('outgoing').value.replace('R$', '').replace(',', '.'));
            const balance = initialBalance + income - outgoing;
            document.getElementById('balanceResult').innerText = `Saldo Disponível: R$ ${balance.toFixed(2).replace('.', ',')}`;
            balanceData = { SaldoInicial: initialBalance, Renda: income, Saídas: outgoing, SaldoDisponível: balance.toFixed(2) };
        });

        document.getElementById('fixedExpensesForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const rent = parseFloat(document.getElementById('rent').value.replace('R$', '').replace(',', '.'));
            const utilities = parseFloat(document.getElementById('utilities').value.replace('R$', '').replace(',', '.'));
            const salaries = parseFloat(document.getElementById('salaries').value.replace('R$', '').replace(',', '.'));
            const fixedExpenses = rent + utilities + salaries;
            document.getElementById('fixedExpensesResult').innerText = `Despesas Fixas: R$ ${fixedExpenses.toFixed(2).replace('.', ',')}`;
            fixedExpensesData = { Aluguel: rent, Utilidades: utilities, Salários: salaries, DespesasFixas: fixedExpenses.toFixed(2) };
        });

    </script>
        <script src="public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>