<?php
include "../connection/connection.php";

$exclusao_sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $sql = "DELETE FROM `product` WHERE idProduto = $id";
    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados);

    if (mysqli_query($conn, $sql)) {
        $exclusao_sucesso = true;
    } else {
        mensagem("Produto: $nome NÃO excluído!", 'danger');
    }
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="imagem/png" href="../logo/6eacc63d-46b9-4a6c-ae9b-fdb9579be941-removebg-preview (2).png"/>
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>JJ Cristão</title>
  </head>
  <body>  
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
                      <li class="active"><a href="pesquisa.php">Estoque</a></li>
                      <li><a href="movimentacao.php">Entrada / Saída</a></li>
                      <li><a href="venda.php">Venda</a></li>
                      <li><a href="financeiro.php">Financeiro</a></li>
                  </ul>
              </nav>
          </div>
      </div>
    </header>
    <section class="banner">
          <div class="sliders" style="margin-left: 0;">
        
          </div>
          <div class="sliders-pointers">
              <div class="pointer active"></div>
              <div class="pointer"></div>
              <div class="pointer"></div>
          </div>
      </section>
      </div>

      <!-- Modal de exclusão bem-sucedida -->
<div class='modal fade <?php echo $exclusao_sucesso ? "show" : ""; ?>' id='exclusao-success' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Exclusão</h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form id='form-exclusao' method='POST'>
                    <div class='form-group'>
                        <?php 
                            echo "<div class='mensagem-container'>";
                            echo "<div class='mensagem-texto'>Produto: <strong>$nome</strong> excluído com sucesso!</div>";
                            echo "</div>";
                        ?>
                    </div>
                    <input type='hidden' name='nome' id='nome_produto' value=''>
                    <input type='hidden' name='id' id='idProduto' value=''>
                </form>
            </div>
            <div class='modal-footer'>
                <a href='pesquisa.php' type='button' class='btn btn-primary' data-bs-dismiss='modal'>Ok</a>
            </div>
        </div>
    </div>
</div>

      <script>
          $(document).ready(function(){
              <?php if ($exclusao_sucesso) { ?>
                  $('#exclusao-success').modal('show');
              <?php } ?>
          });
      </script>  

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
