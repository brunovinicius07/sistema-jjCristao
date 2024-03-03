<?php 
    $server = "localhost";
    $user = "root";
    $password = "12345678";
    $db = "jjCristao";

    if ( $conn = mysqli_connect($server, $user, $password, $db) ) {
      //  echo "Conectado!";
    } else {
        echo "Error!";
    }

    function mensagem($texto, $tipo){
      echo "<div class='alert alert-$tipo d-flex align-items-center' role='alert'>
              <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/> 
              </svg>
              <div>
                $texto
              </div>
            </div>";
    }

    function mostrarData($data){
      $dt = explode('-', $data);
      return $dt[2] . "/" . $dt[1] . "/" . $dt[0];
    }
?>