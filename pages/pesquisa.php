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

    <title>Pesquisar</title>
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
                    <li class="active"><a href="pesquisa.php">Estoque</a></li>
                    <li><a href="movimentacao.php">Entrada / Saída</a></li>
                    <li><a href="venda.php">Venda</a></li>
                    <li><a href="financeiro.php">Financeiro</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<?php     
    $pesquisa = $_POST['busca'] ?? '';

    include "../connection/connection.php";

    $sql = "SELECT * FROM product WHERE nome LIKE '%$pesquisa%'";

    $dados = mysqli_query($conn, $sql)
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Pesquisar</h1>
            <nav style="background-color: #F6F3EA;" >
                <form class="form-inline" action="pesquisa.php" method="POST">
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
                        <th>Valor Compra</th>
                        <th>Valor Venda</th>
                        <th>Quantidade</th>
                        <th>Data de Registro</th>
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
                            $valorCompra = $linha['valorCompra']; 
                            $valorVenda = $linha['valorVenda']; 
                            $quantidade = $linha['quantidade']; 
                            $imagem = $linha['imagem'];
                            $dataRegistro = $linha['dataRegistro']; 
                            $dataRegistro = mostrarData($dataRegistro); 

                            echo "<tr>
                                    <th><img src='../img/$imagem' class='lista_img'></th>
                                    <th scope='row'>$nome</th>
                                    <td>$material</td>
                                    <td>$tamanho cm</td>
                                    <td>R$ $valorCompra</td>
                                    <td>R$ $valorVenda</td>
                                    <td>$quantidade uni</td>
                                    <td>$dataRegistro</td>
                                    <td width=180px>
                                        <a href='cadastro_put.php?id=$idProduto' class='btn btn-primary'>Editar</a>
                                        <button class='btn btn-danger' data-toggle='modal' data-target='#confirma' onclick='obterDados($idProduto, \"$nome\", \"$imagem\")'>Excluir</button>

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
<div class="modal fade" id="confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>    
            </div>
            <div class="modal-body">
                <form action="delete_script.php" method="POST">
                <?php 
                            echo "<div class='mensagem-container'>";
                            echo "<div id='imagem_produto' class='mostrar_image'></div>";
                            echo "<div class='mensagem-texto'>Deseja realmente excluir <b id='nome'></b>?    
                                  </div>";
                        ?>
            </div>
            <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Não</a>
                    <input type="hidden" name="nome" id="nome_produto" value="">
                    <input type="hidden" name="id" id="idProduto" value="">
                    <input type="hidden" name="imagem" id="imagem_produto" value="">
                    <input type="submit" class="btn btn-danger" value="Sim">
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function obterDados(id, nome, imagemUrl){
        document.getElementById('nome').innerHTML = nome;
        document.getElementById('nome_produto').value = nome;
        document.getElementById('idProduto').value = id;
        document.getElementById('imagem_produto').innerHTML = "<img src='../img/" + imagemUrl + "' class='mostrar_image'>";
    }
</script>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
