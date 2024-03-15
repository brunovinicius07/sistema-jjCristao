<?php
include "../connection/connection.php";

$edicao_sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $material  = $_POST['material'];
    $tamanho = $_POST['tamanho'];
    $valorCompra = $_POST['valorCompra'];
    $valorVenda = $_POST['valorVenda'];
    $dataRegistro = date("Y-m-d");

    // Se necessário, você pode adicionar aqui a lógica para mover a imagem
    // para o diretório desejado e atualizar o nome da imagem no banco de dados

    $sql = "UPDATE `product` SET `nome` = '$nome', `material` = '$material', `tamanho` = $tamanho, `valorCompra` = $valorCompra, `valorVenda` = $valorVenda WHERE idProduto = $id";

    if (mysqli_query($conn, $sql)) {
        $edicao_sucesso = true;
    } else {
        mensagem("Produto: $nome NÃO alterado!", 'danger');
    }
}

// Obter os dados do produto atualizados para exibição
$id = $_GET['id'] ?? '';
$sql = "SELECT * FROM product WHERE idProduto = $id";
$dados = mysqli_query($conn, $sql);
$linha = mysqli_fetch_assoc($dados);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" type="imagem/png" href="../logo/6eacc63d-46b9-4a6c-ae9b-fdb9579be941-removebg-preview (2).png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Editar Produto</title>
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
                    <li class="active"><a href="pesquisa.php">Estoque</a></li>
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
            <h1>Editar Produto</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Produto</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome Produto" required value="<?php echo $linha['nome'];?>">
                </div>
                <div class="form-group">
                    <label for="material">Material</label>
                    <input type="text" class="form-control" name="material" placeholder="ex: Borracha / Madeira /  Resina..." required value="<?php echo $linha['material'];?>">
                </div>
                <div class="form-group">
                    <label for="tamanho">Tamanho</label>
                    <input type="number" class="form-control" name="tamanho" placeholder="Centímetros" value="<?php echo $linha['tamanho'];?>">
                </div>
                <div class="form-group">
                    <label for="valorCompra">Valor de Compra</label>
                    <input type="number" class="form-control" name="valorCompra" placeholder="Preço" step="0.01" required value="<?php echo $linha['valorCompra'];?>">
                </div>
                <div class="form-group">
                    <label for="valorVenda">Valor de Venda</label>
                    <input type="number" class="form-control" name="valorVenda" placeholder="Preço" step="0.01" required value="<?php echo $linha['valorVenda'];?>">   
                </div>
                <input type="hidden" name="id" value="<?php echo $linha['idProduto'] ?>">
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Salvar Alterações">
                </div>
            </form>
            <a href="pesquisa.php" class="btn btn-info">Voltar</a>
        </div>
    </div>
</div>

<!-- Modal de sucesso -->
<div class='modal fade <?php echo $edicao_sucesso ? "show" : ""; ?>' id='edicao-success' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Editado</h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form id='form-entrada' method='POST'>
                    <div class='form-group'>
                        <?php 
                            echo "<div class='mensagem-container'>";
                            echo "<img src='../img/" . $linha['imagem'] . "' title='" . $linha['imagem'] . "' class='mostrar_image'>";
                            echo "<div class='mensagem-texto'>Produto: <strong>$nome</strong> editado com sucesso!";
                            echo "</div>";
                            echo "</div>";
                        ?>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <a href='pesquisa.php' type='button' class='btn btn-primary' data-bs-dismiss='modal'>Voltar</a>
            </div>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php if ($edicao_sucesso): ?>
    <script>
        $(document).ready(function(){
            $('#edicao-success').modal('show');
        });
    </script>
<?php endif; ?>
</body>
</html>

