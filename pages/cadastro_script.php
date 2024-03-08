<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cadastro</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <?php 
                include "../connection/connection.php";

                $nome = $_POST['nome'];
                $material  = $_POST['material'];
                $tamanho = $_POST['tamanho'];
                $valorCompra = $_POST['valorCompra'];
                $valorVenda = $_POST['valorVenda'];
                $quantidade = $_POST['quantidade'];
                $dataRegistro = date("Y-m-d");

                $imagem = $_FILES['imagem'];
                $nomeImagem = moverImagem($imagem);
                
                $sql = "INSERT INTO `produto`(`nome`, `material`, `tamanho`, `valorCompra`, `valorVenda`, `quantidade`,     
                                              `dataRegistro`, `imagem`)
                VALUES ('$nome', '$material', '$tamanho', '$valorCompra', '$valorVenda', '$quantidade', '$dataRegistro', 
                        '$nomeImagem')";

                if (mysqli_query($conn, $sql)) {
                    echo "<img src='../img/$nomeImagem' title='$nomeImagem' class='mostrar_img'>";
                    mensagem("Produto: <strong>$nome</strong> cadastrado com sucesso!", 'success');
                } else {
                mensagem("Produto: $nome NÃO cadastrado!", 'danger');
            }
            ?>
            <hr>
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
