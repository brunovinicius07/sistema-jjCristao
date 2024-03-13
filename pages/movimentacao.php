<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" type="imagem/png" href="../logo/6eacc63d-46b9-4a6c-ae9b-fdb9579be941-removebg-preview (2).png"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pesquisar</title>
</head>
<body style="background-color: #F6F3EA;">
<header>
    <div class="header">
        <div class="logo">
            <div class="logoimg"><a href=""><img src="../logo/6eacc63d-46b9-4a6c-ae9b-fdb9579be941-removebg-preview (2).png" alt=""></a></div>
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

// Verifica se o formulário de entrada foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantidade-entrada'])) {
    $idProduto = $_POST['id'];
    $quantidadeEntrada = $_POST['quantidade-entrada'];

    // Consulta para obter a quantidade atual do produto
    $consultaProduto = "SELECT quantidade FROM product WHERE idProduto = $idProduto";
    $resultadoConsulta = mysqli_query($conn, $consultaProduto);

    if ($resultadoConsulta) {
        $linha = mysqli_fetch_assoc($resultadoConsulta);
        $quantidadeAtual = $linha['quantidade'];

        // Calcula a nova quantidade
        $novaQuantidade = $quantidadeAtual + $quantidadeEntrada;

        // Atualiza a quantidade no banco de dados
        $atualizaQuantidade = "UPDATE product SET quantidade = $novaQuantidade WHERE idProduto = $idProduto";
        $resultadoAtualizacao = mysqli_query($conn, $atualizaQuantidade);
    } else {
        echo "<script>alert('Erro ao obter quantidade atual do produto.');</script>";
    }

    header("Location: movimentacao.php?" . http_build_query($_GET));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantidade-saida'])) {
    $idProduto = $_POST['id'];
    $quantidadeSaida = $_POST['quantidade-saida'];

    // Consulta para obter a quantidade atual do produto
    $consultProduto = "SELECT quantidade FROM product WHERE idProduto = $idProduto";
    $resultConsulta = mysqli_query($conn, $consultProduto);

    if ($resultConsulta) {
        $linha = mysqli_fetch_assoc($resultConsulta);
        $quantidadeAtual = $linha['quantidade'];

        // Corrigindo o cálculo da nova quantidade
        $novaQuantidade = $quantidadeAtual - $quantidadeSaida; // Usando $quantidadeSaida em vez de $quantidadeEntrada

        // Atualiza a quantidade no banco de dados
        $atualizaQuantidade = "UPDATE product SET quantidade = $novaQuantidade WHERE idProduto = $idProduto";
        $resultadoAtualizacao = mysqli_query($conn, $atualizaQuantidade);

    } else {
        echo "<script>alert('Erro ao obter quantidade atual do produto.');</script>";
    }

    header("Location: movimentacao.php?" . http_build_query($_GET));
    exit();
}


$pesquisa = $_POST['busca'] ?? '';
$sql = "SELECT * FROM product WHERE nome LIKE '%$pesquisa%'";
$dados = mysqli_query($conn, $sql)
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
                            <a href='#' class='btn btn-primary' data-toggle='modal' data-target='#entrada' onclick='obterDados($idProduto, \"$nome\")'>Entrada</a>
                            <a href='#' class='btn btn-success' data-toggle='modal' data-target='#saida' onclick='obterDados($idProduto, \"$nome\")'>Saída</a>
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

<!-- Modal -->
<div class="modal fade" id="entrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Entrada de Produtos em Estoque</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-entrada" method="POST">
                    <div class="form-group">
                        <p>Informe a quantidade de <b id="nome"></b> para entrada em estoque:</p>
                        <input type="number" id="quantidade-entrada" class="form-control" name="quantidade-entrada" placeholder="Unidades" required>
                    </div>
                    <input type="hidden" name="nome" id="nome_produto" value="">
                    <input type="hidden" name="id" id="idProduto" value="">
                </form>
            </div>
            <div class="modal-footer">
                <a href="movimentacao.php" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</a>
                <button type="submit" form="form-entrada" class="btn btn-success">Adicionar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="saida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Saída de Produtos em Estoque</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-saida" method="POST">
                    <div class="form-group">
                        <p>Informe a quantidade de <b id="nome_saida"></b> para saída em estoque:</p>
                        <input type="number" id="quantidade-saida" class="form-control" name="quantidade-saida" placeholder="Unidades" required>
                    </div>
                    <input type="hidden" name="nome" id="nome" value="">
                    <input type="hidden" name="id" id="idProdutoSaida" value="">
                </form>
            </div>
            <div class="modal-footer">
                <a href="movimentacao.php" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</a>
                <button type="submit" form="form-saida" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function obterDados(id, nome){
        document.getElementById('nome').innerHTML = nome;
        document.getElementById('nome_saida').innerHTML = nome;
        document.getElementById('nome_produto').value = nome;
        document.getElementById('idProduto').value = id;
    }
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
