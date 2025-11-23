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
require_once("./model/Consultorio.php");
require_once("./model/Paciente.php");
require_once("./model/Medico.php");

$listaconsulta = Consulta :: listar();
$listaconsultorio = Consultorio :: listar();
$listamedico = Medico :: listar_medico();
$listapaciente = Paciente :: listar_paciente();


if(isMetodo("POST")){
    
    $id = $_POST["id"];
    $flag = false;
    for($a = 0; $a < count($listaconsulta); $a++ ){
        $con = $listaconsulta[$a]["id_paciente"];
        if($con == $id){
            $flag = true;
        }
    }

    if($flag){
        $message = "Esse(a) paciente(a) tem uma consulta marcado!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }else{
        $res = Paciente :: deletar($_POST["id"]);

        if(!$res){
            $message = "Paciente(a) deletado(a) com sucesso";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
            echo"<p>Erro ao deletar o(a) paciente(a)</p>";
        }
    }
}

if(isMetodo("GET")){ 
if(parametrosValidos($_GET, ["id"])){
    if(Paciente:: existe($_GET["id"])){
        $paciente = Paciente ::get($_GET["id"]);
    }else{
        $message = "Esse(a) paciente(a) não existe!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        die;
    }

}else{
    $message = "ID não foi enviado!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die;
}
}

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
        <h2>Deletar Paciente</h2>
        <form method="POST">
            
            <input type="hidden" name="id" value="<?=$paciente["id"]?>">
            <br>
            <br>
            <a href="Consultoriop.php"><button>Deletar</button></a>
        </form>
    </div>




      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>