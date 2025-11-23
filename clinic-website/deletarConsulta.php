<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php

require_once("./config/utils.php");
require_once("./model/Consulta.php");
require_once("./model/Paciente.php");
require_once("./model/Medico.php");


if(isMetodo("POST")){
    
        $res = Consulta :: deletar($_POST["id"]);
        if(!$res){
            $message = "Consulta deletada com sucesso";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
            echo"<p>Erro ao deletar a consulta</p>";
        }
}

if(isMetodo("GET")){ 
    if(parametrosValidos($_GET, ["id"])){
        if(Consulta:: existe($_GET["id"])){
            $consulta = Consulta ::get($_GET["id"]);
        }else{
            echo"<p>Essa consulta não existe!</p>";
            die;
        }

    }else{
        echo" <p> ID não foi enviado</p>";
        die;
    }
}

$listaconsulta = Consulta :: listar();
$listamedico = Medico :: listar_medico();
$listapaciente = Paciente :: listar_paciente();

?>
<nav class="menu1 navbar navbar-expand-lg a navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="./index.php">Menu <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultap.php">Consulta <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultoriop.php">Consultorio <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Pacientep.php">Paciente <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Medicop.php">Médico <span class="sr-only"></span></a>
        </div>
    </div>
        </nav>
    <div class="bloco1 text-center">
        <h2>Deletar Consulta</h2>
        <form method="POST">
            <!-- <p>Confira a data:</p>
            <p><?=$consulta["data"]?></p>
            <br>
            <br>
            <p>Confira o horário</p>
            <p><?=$consulta["hora"]?></p>
            <br>
            <br>
            <p>Confira o id do médico</p>
            <p><?=$consulta["id_medico"]?></p>
            <br>
            <br>
            <p>Confira id do paciente</p>
            <p><?=$consulta["id_paciente"]?></p> -->
            <input type="hidden" name="id" value="<?=$consulta["id"]?>">
            <br>
            <br>
            <a href="Consultap.php"><button>Deletar</button></a>
        </form>
    </div>




      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>