<?php
if (isset($_GET['produtos'])) {
    $produtosSelecionados = $_GET['produtos'];
    $idsProdutos = explode(',', $produtosSelecionados);
    include "../connection/connection.php";

    $sql = "SELECT * FROM product WHERE idProduto IN (" . implode(',', $idsProdutos) . ")";
    $result = mysqli_query($conn, $sql);

    $dados = array();
    while ($linha = mysqli_fetch_assoc($result)) {
        $dados[] = $linha;
    }

} else {
    header("Location: pesquisa.php");
    exit();
}
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" type="imagem/png" href="../logo/jj-colorido-2.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Confirmação de Venda</title>
</head>
<body style="background-color: #F6F3EA;">
<header>
    <div class="header">
        <div class="logo">
            <div class="logoimg"><a href=""><img src="../logo/jj-colorido-1.png" alt=""></a></div>
        </div>
        <div class="menu">
            <img class="menu-opener" src="assets/images/menu.png">
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cadastro.php">Cadastrar Produto</a></li>
                    <li><a href="pesquisa.php">Estoque</a></li>
                    <li><a href="movimentacao.php">Entrada / Saída</a></li>
                    <li class="active"><a href="venda.php">Venda</a></li>
                    <li><a href="financeiro.php">Financeiro</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>



<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h1 class="mb-4">Confirmação de Venda</h1>

             <form action="" method="POST" enctype="multipart/form-data">
             <div class="row">
                 <?php foreach ($dados as $linha) { ?>
                     <?php
                     $idProduto = $linha['idProduto'];
                     $nome = $linha['nome'];
                     $valorCompra = $linha['valorCompra'];
                     $valorVenda = $linha['valorVenda'];
                     $imagem = $linha['imagem'];
                     ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="../img/<?php echo $imagem; ?>" class="card-img-top" alt="Imagem do Produto">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $nome; ?></h5>
                                    <p class="card-text">Preço de Compra: R$ <?php echo $valorCompra; ?></p>
                                    <p class="card-text">Preço de Venda: R$ <?php echo $valorVenda; ?></p>
                                    <div class="form-group">
                                        <label for="quantidade_<?php echo $idProduto; ?>">Quantidade:</label>
                                        <input type="number" class="form-control" id="quantidade_<?php echo $idProduto; ?>" name="quantidade_<?php echo $idProduto; ?>" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tem Desconto?</h5>
                                <div class="form-group">
                                    <label>Informe se houve desconto:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="desconto_global" id="desconto_sim_global" value="sim" onclick="toggleDescontoGlobal()">
                                        <label class="form-check-label" for="desconto_sim_global">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="desconto_global" id="desconto_nao_global" value="nao" onclick="toggleDescontoGlobal()" checked>
                                        <label class="form-check-label" for="desconto_nao_global">Não</label>
                                    </div>
                                </div>
                                <div class="form-group" id="campo_desconto_global" style="display: none;">
                                    <label for="valor_desconto_global">Valor do Desconto:</label>
                                    <input type="number" class="form-control" id="valor_desconto_global" name="valor_desconto_global" placeholder="R$:">
                                </div>
                                <p><strong>Valor Total da Venda: R$ <span id="valor_total_compra"></span></strong></p>
                                <p><strong>Valor Total Com Desconto: R$ <span id="valor_total_compra_com_desconto"></strong></span></p>
                            </div>
                        </div>
                    </div>

                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmarVendaModal" onclick="capturarQuantidade()">Confirmar Venda</button>
            </form>

            <a href="venda.php" class="btn btn-info mt-3">Voltar</a>
        </div>
    </div>
</div>

<!-- Modal de confirmação de venda -->
<div class="modal fade" id="confirmarVendaModal" tabindex="-1" role="dialog" aria-labelledby="confirmarVendaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarVendaModalLabel">Venda Realizada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Produto(s) vendido(s):</p>
                <ul>
                    <?php foreach ($dados as $linha) { ?>
                        <li><?php echo $linha['nome']; ?></li>
                    <?php } ?>
                </ul>
                <p>Valor Total da Venda: R$ <span id="valor_total_venda"></span></p> <!-- Adicionando um id para o span -->
            </div>
            <div class="modal-footer">
                <a href="venda.php" class="btn btn-success">OK</a>
            </div>
        </div>
    </div>
</div>

<!-- Adicione este script no final do seu arquivo HTML -->
<script>
    // Função para capturar o valor da quantidade e calcular o total
    function capturarQuantidade() {
        var todasAsQuantidadesValidas = true;
        var totalVenda = 0;
        var totalVendaComDesconto = 0;

        <?php foreach ($dados as $linha) { ?>
            var inputQuantidade = document.getElementById('quantidade_<?php echo $linha['idProduto']; ?>');
            var quantidade = parseInt(inputQuantidade.value);

            if (quantidade === 0) {
                alert("Por favor, insira uma quantidade válida para o produto <?php echo $linha['nome']; ?>.");
                return; // Retorna para evitar a abertura do modal
            }

            // Aqui você pode fazer qualquer cálculo necessário, por exemplo, somar o preço do produto vezes a quantidade
            totalVenda += (quantidade * <?php echo $linha['valorVenda']; ?>);
        <?php } ?>

        var descontoGlobalCheckbox = document.getElementById('desconto_sim_global');
        var descontoGlobal = descontoGlobalCheckbox.checked;

        if (descontoGlobal) {
            // Obtém o valor do desconto informado pelo usuário
            var valorDesconto = parseFloat(document.getElementById('valor_desconto_global').value);
            // Calcula o total com desconto
            totalVendaComDesconto = totalVenda - valorDesconto;
        } else {
            // Se não houver desconto, o total com desconto é o mesmo que o total sem desconto
            totalVendaComDesconto = totalVenda;
        }

        // Exibindo o valor total da venda
        document.getElementById('valor_total_compra_com_desconto').textContent = totalVendaComDesconto.toFixed(2);
        document.getElementById('valor_total_venda').textContent = totalVenda.toFixed(2); // Exibe o total sem desconto
    }

    function toggleDescontoGlobal() {
        var campoDesconto = document.getElementById('campo_desconto_global');
        var descontoCheckbox = document.getElementById('desconto_sim_global');

        if (descontoCheckbox.checked) {
        campoDesconto.style.display = 'block';
        } else {
            campoDesconto.style.display = 'none';
            // Se o usuário escolheu "Não" para desconto, redefine o valor do campo de desconto para 0
            document.getElementById('valor_desconto_global').value = "R$:";
            // Recalcula o valor total da venda com desconto
            capturarQuantidade();
        }
    }

    // Chame esta função quando precisar capturar o valor
    capturarQuantidade();

    document.getElementById('valor_desconto_global').addEventListener('input', function() {
        // Chama a função capturarQuantidade para recalcular o valor total com desconto
        capturarQuantidade();
    });

    // Função para atualizar o valor total da compra ao alterar a quantidade
    function atualizarValorTotalCompra() {
        var totalCompra = 0;

        <?php foreach ($dados as $linha) { ?>
            var inputQuantidade = document.getElementById('quantidade_<?php echo $linha['idProduto']; ?>');
            var quantidade = parseInt(inputQuantidade.value);
            totalCompra += (quantidade * <?php echo $linha['valorVenda']; ?>);
        <?php } ?>

        document.getElementById('valor_total_compra').textContent = totalCompra.toFixed(2);
    }

    // Chame esta função quando precisar atualizar o valor total da compra
    atualizarValorTotalCompra();

</script>

<script>
    // Chame esta função quando a página carregar
    window.onload = function() {
        toggleDescontoGlobal();
    };
</script>

<script>
    // Obtém todos os campos de quantidade com ID dinâmico
    var camposQuantidade = document.querySelectorAll('[id^="quantidade_"]');

    // Adiciona um evento input a cada campo de quantidade
    camposQuantidade.forEach(function(campo) {
        campo.addEventListener('input', function() {
            atualizarValorTotalCompra(); // Chama a função para atualizar o valor total da compra
            capturarQuantidade(); // Chama a função para recalcular o valor total com desconto
        });
    });
</script>



<script>
    function atualizarValorTotalCompra() {
        var totalCompra = 0;

        <?php foreach ($dados as $linha) { ?>
            var inputQuantidade = document.getElementById('quantidade_<?php echo $linha['idProduto']; ?>');
            var quantidade = parseInt(inputQuantidade.value);
            totalCompra += (quantidade * <?php echo $linha['valorVenda']; ?>);
        <?php } ?>

        document.getElementById('valor_total_compra').textContent = totalCompra.toFixed(2);
    }
</script>

<script>
    // Adiciona um evento input ao campo de desconto
    document.getElementById('valor_desconto_global').addEventListener('input', function() {
        // Chama a função capturarQuantidade para recalcular o valor total com desconto
        capturarQuantidade();
    });
</script>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

