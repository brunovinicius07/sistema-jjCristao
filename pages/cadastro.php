<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cadastro</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Cadastro de Itens</h1>
                <form action="cadastro_script.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome Produto</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome Produto" require>
                    </div>
                    <div class="form-group">
                        <label for="material">Material</label>
                        <input type="text" class="form-control" name="material" placeholder="ex: Borracha / Madeira /  Resina..." require>
                    </div>
                    <div class="form-group">
                        <label for="tamanho">Tamanho</label>
                        <input type="number" class="form-control" name="tamanho" placeholder="Centímetros" require>
                    </div>
                    <div class="form-group">
                        <label for="valorCompra">Valor de Compra</label>
                        <input type="number" class="form-control" name="valorCompra" placeholder="Preço" step="0.01" 
                                                                                                               require>
                    </div>
                    <div class="form-group">
                        <label for="valorVenda">Valor de Venda</label>
                        <input type="number" class="form-control" name="valorVenda" placeholder="Preço" step="0.01" require>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" name="quantidade" placeholder="Unidades" require>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" class="form-control" name="imagem" accept=".jpg, .jpeg, .png, .gif" >
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Cadastrar">
                    </div>
                
                </form>
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