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

    <title>Venda</title>
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

                            echo "<tr>
                                    <th><img src='../img/$imagem' class='lista_img'></th>
                                    <th scope='row'>$nome</th>
                                    <td>$material</td>
                                    <td>$tamanho cm</td>
                                    <td>R$ $valorCompra</td>
                                    <td>R$ $valorVenda</td>
                                    <td>$quantidade uni</td>
                                    <td width=180px>
                                        
                                    <button id='btn_$idProduto' class='btn btn-info' data-toggle='modal' data-target='#confirma' onclick='selecionarParaVenda($idProduto, \"$nome\", \"$imagem\")'>ADICIONAR À CARRINHO</button>

                                    </td>
                                </tr>";
                        }
                    ?>
                    
                    <script type="text/javascript">
                        // Lista para armazenar os IDs dos produtos selecionados
                        var produtosSelecionados = [];

                        function selecionarParaVenda(id, nome, imagemUrl) {
                            var botao = document.getElementById('btn_' + id);
                            if (botao.innerHTML === 'ADICIONADO') {
                                // Remover o ID do produto da lista de selecionados
                                var index = produtosSelecionados.indexOf(id);
                                if (index !== -1) {
                                    produtosSelecionados.splice(index, 1);
                                }
                                botao.innerHTML = 'ADICIONAR À CARRINHO';
                                botao.classList.remove('btn-sucess');
                                botao.classList.add('btn-info');
                            } else {
                                // Adicionar o ID do produto à lista de selecionados
                                produtosSelecionados.push(id);
                                botao.innerHTML = 'ADICIONADO';
                                botao.classList.remove('btn-info');
                                botao.classList.add('btn-success');
                                obterDados(id, nome, imagemUrl);
                            }
                        }

                        function redirecionarParaVenda() {
                            if (produtosSelecionados.length > 0) {
                                // Construir a URL da página de confirmação de venda com os IDs dos produtos selecion
                                var url = 'venda_confirma.php?produtos=' + produtosSelecionados.join(',');
                                // Redirecionar para a página de confirmação de venda
                                window.location.href = url;
                            } else {
                                alert('Nenhum produto selecionado. \n \n Selecione ao menos um produto para venda!');
                            }
                        }
                    </script>

                </tbody>
            </table>

            <a href="index.php" class="btn btn-info">Voltar</a>
            <button onclick="redirecionarParaVenda()" class="btn btn-primary">Vender Produtos Selecionados</button>
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
