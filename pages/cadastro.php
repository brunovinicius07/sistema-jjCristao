<?php
include "../connection/connection.php";

$cadastro_sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $material  = $_POST['material'];
    $tamanho = $_POST['tamanho'];
    $valorCompra = $_POST['valorCompra'];
    $valorVenda = $_POST['valorVenda'];
    $quantidade = $_POST['quantidade'];
    $dataRegistro = date("Y-m-d");

    $imagem = $_FILES['imagem'];
    $nomeImagem = moverImagem($imagem);
    
    $sql = "INSERT INTO `product`(`nome`, `material`, `tamanho`, `valorCompra`, `valorVenda`, `quantidade`,  `dataRegistro`, `imagem`)
    VALUES ('$nome', '$material', '$tamanho', '$valorCompra', '$valorVenda', '$quantidade', '$dataRegistro', '$nomeImagem')";

    if (mysqli_query($conn, $sql)) {
        $cadastro_sucesso = true;
    } else {
        mensagem("Produto: $nome NÃO cadastrado!", 'danger');
    }
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
    <title>Cadastro</title>
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
                    <li class="active"><a href="cadastro.php">Cadastrar Produto</a></li>
                    <li><a href="pesquisa.php">Estoque</a></li>
                    <li><a href="movimentacao.php">Entrada / Saída</a></li>
                    <li><a href="venda.php">Venda</a></li>
                    <li><a href="financeiro.php">Financeiro</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Cadastro de Itens</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome Produto</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome Produto" required>
                </div>
                <div class="form-group">
                    <label for="material">Material</label>
                    <input type="text" class="form-control" name="material" placeholder="ex: Borracha / Madeira /  Resina..." required>
                </div>
                <div class="form-group">
                    <label for="tamanho">Tamanho</label>
                    <input type="number" class="form-control" name="tamanho" placeholder="Centímetros" required>
                </div>
                <div class="form-group">
                    <label for="valorCompra">Valor de Compra</label>
                    <input type="number" class="form-control" name="valorCompra" placeholder="Preço" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="valorVenda">Valor de Venda</label>
                    <input type="number" class="form-control" name="valorVenda" placeholder="Preço" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade" placeholder="Unidades" required>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem</label>
                    <input type="file" class="form-control" name="imagem" accept="image/*" >
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                </div>
            </form>
            <a href="index.php" class="btn btn-info">Voltar</a>
        </div>
    </div>
</div>

<!-- Modal de sucesso -->
<div class='modal fade <?php echo $cadastro_sucesso ? "show" : ""; ?>' id='cadastro-success' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Cadastrado</h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form id='form-entrada' method='POST'>
                    <div class='form-group'>
                        <?php 
                            echo "<div class='mensagem-container'>";
                            echo "<img src='../img/$nomeImagem' title='$nomeImagem' class='mostrar_image'>";
                            echo "<div class='mensagem-texto'>Produto: <strong>$nome</strong> cadastrado com sucesso!</div>";
                            echo "</div>";
                        ?>
                    </div>
                    <input type='hidden' name='nome' id='nome_produto' value=''>
                    <input type='hidden' name='id' id='idProduto' value=''>
                </form>
            </div>
            <div class='modal-footer'>
                <a href='cadastro.php' type='button' class='btn btn-success' data-bs-dismiss='modal'>Cadastrar Outro Produto</a>
                <a href='pesquisa.php' type='button' class='btn btn-primary' data-bs-dismiss='modal'>Verificar Estoque</a>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- JavaScript para mostrar o modal se o cadastro foi bem-sucedido -->
<script>
    $(document).ready(function(){
        <?php if ($cadastro_sucesso) { ?>
            $('#cadastro-success').modal('show');
        <?php } ?>
    });
</script>

</body>
</html>