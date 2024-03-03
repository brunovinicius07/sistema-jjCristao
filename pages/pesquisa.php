<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pesquisar</title>
  </head>
  <body>

    <?php     
        $pesquisa = $_POST['busca'] ?? '';

        include "../connection.php";

        $sql = "SELECT * FROM produtos WHERE nome LIKE '%$pesquisa%'";

        $dados = mysqli_query($conn, $sql)
    ?>




    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Pesquisar</h1>
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline" action="pesquisa.php" method="POST">
                       <input class="form-control mr-sm-2" type="search" placeholder="Produto" aria-label="Search" name="busca" autofocus>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                    </form>
                </nav>

                <table class="table table-hover">
                    <thead>
                        <tr>
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
                               $dataRegistro = $linha['dataRegistro']; 
                               $dataRegistro = mostrarData($dataRegistro); 

                               echo "<tr>
                                        <th scope='row'>$nome</th>
                                        <td>$material</td>
                                        <td>$tamanho</td>
                                        <td>$valorCompra</td>
                                        <td>$valorVenda</td>
                                        <td>$quantidade</td>
                                        <td>$dataRegistro</td>
                                        <td width=180px>
                                            <a href = 'cadastro_put.php?id=$idProduto' class = 'btn btn-success'>Editar</a>
                                            <a href = '#' class = 'btn btn-danger'>Excluir</a>
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>