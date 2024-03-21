<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" type="imagem/png" href="../logo/jj-colorido-2.png"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Movimentação</title>
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
                    <li class="active"><a href="movimentacao.php">Entrada / Saída</a></li>
                    <li><a href="venda.php">Venda</a></li>
                    <li><a href="financeiro.php">Financeiro</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<?php
include "../connection/connection.php";

$pesquisa = $_POST['busca'] ?? '';
$sql = "SELECT * FROM product WHERE nome LIKE '%$pesquisa%'";
$dados = mysqli_query($conn, $sql);

if(isset($_GET['idProduto']) && isset($_GET['quantidade'])) {
    $idProduto = $_GET['idProduto'];
    $quantidadeEntrada = $_GET['quantidade'];

    // Consulta ao banco de dados para obter as informações do produto
    $consultaProduto = "SELECT * FROM product WHERE idProduto = $idProduto";
    $resultadoConsulta = mysqli_query($conn, $consultaProduto);

    // Produto encontrado, obtenha os dados
    $produto = mysqli_fetch_assoc($resultadoConsulta);

    // Agora você pode acessar os dados do produto conforme necessário
    $name = $produto['nome'];
    $img = $produto['imagem'];
    $quantidadeAtual = $produto['quantidade'];
        
} 
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Pesquisar</h1>
            <nav style="background-color: #F6F3EA;" >
                <form class="form-inline" action="movimentacao.php" method="POST">
                    <input class="form-control mr-sm-2" type="search" placeholder="Produto" aria-label="Search" name="busca" autofocus>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </nav>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Material</th>
                    <th>Tamanho</th>
                    <th>Quantidade</th>
                    <th>Funções</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($linha = mysqli_fetch_assoc($dados)) {
                    $idProduto = $linha['idProduto'];
                    $nome = $linha['nome'];
                    $material = $linha['material'];
                    $tamanho = $linha['tamanho'];
                    $quantidade = $linha['quantidade'];
                    $imagem = $linha['imagem'];

                    echo "<tr>
                        <th><img src='../img/$imagem' class='lista_img'></th>
                        <th scope='row'>$nome</th>
                        <td>$material</td>
                        <td>$tamanho cm</td>
                        <td>$quantidade uni</td>
                        <td width=180px>
                            <a href='#' class='btn btn-primary' data-toggle='modal' data-target='#entrada' onclick='obterDados($idProduto, \"$nome\", \"$imagem\")'>Entrada</a>
                            <a href='#' class='btn btn-success' data-toggle='modal' data-target='#saida' onclick='obterDados($idProduto, \"$nome\", \"$imagem\")'>Saída</a>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>

            <a href="index.php" class="btn btn-info">Voltar</a>
        </div>
    </div>
</div>

     
<div class="modal fade show" id="entrada-success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Movimentação no Estoque</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='mensagem-container'>
                    <img src='../img/<?php echo $img; ?>' title='<?php echo $img; ?>' class='mostrar_image'>
                    <div class='mensagem-texto'>
                    <div>Movimentação do produto <strong><?php echo $name; ?></strong> realizada com sucesso!<br>Quantidade atual no estoque: 
                        <span class='quantidade-red'><?php echo $quantidadeAtual; ?> unidades.</span>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href='movimentacao.php' type='button' class='btn btn-success' data-bs-dismiss='modal'>Voltar</a>
            </div>
        </div>
    </div>
</div>

<!-- Inclua as bibliotecas jQuery e Bootstrap apenas uma vez -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Coloque o script para mostrar o modal dentro do corpo do HTML -->
<script>
    $(document).ready(function(){
        $("#entrada-success").modal('show');
    });
</script>

</body>
</html>
