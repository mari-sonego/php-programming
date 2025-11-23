<!DOCTYPE html>
<html lang="en">
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
require_once("./model/Medico.php");
require_once("./model/Consultorio.php");


if(isMetodo("POST")){
    if(parametrosValidos($_POST, ["id","nome","crm","telefone","id_consutorio"])){
        $res = Medico :: editar($_POST["id"],$_POST["nome"],$_POST["crm"],$_POST["telefone"], $_POST["id_consutorio"]);
        if($res){
            $message = "Médico(a) editado(a) com sucesso";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
            echo"<p>Erro ao editar o(a) médico(a)</p>";
        }
        die;
    }else{
        echo"<p>Erro ao editar o(a) médico(a), parâmetros inválidos</p>";
        die;
    }
}

if(isMetodo("GET")){ 
    if(parametrosValidos($_GET, ["id"])){
        if(Medico:: existe($_GET["id"])){
            $medico = Medico ::get($_GET["id"]);
        }else{
            echo"<p>Esse(a) médico(a) não existe!</p>";
            die;
        }

    }else{
        echo" <p> ID não foi enviado</p>";
        die;
    }
}

$listaconsultorios = Consultorio :: listar();
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
    <div class="bloco1">
        <h2>Editar <?=$medico["nome"]?></h2>
        <form method="POST">
            <p>Digite seu nome</p>
            <input type="text" name="nome" value="<?=$medico["nome"]?>" required>
            <p>Digite seu crm</p>
            <input type="text" name="crm" value="<?=$medico["crm"]?>" required>
            <p>Digite seu telefone</p>
            <input type="text" name="telefone" value="<?=$medico["telefone"]?>"required>
            <p>Selecione o nome do consultório</p>
            <select name="id_consutorio" value="<?=$medico["id_consutorio"]?>">
                <?php
                    foreach($listaconsultorios as $consultorio){
                        $id = $consultorio['id'];
                        $nome = $consultorio['nome'];
                        echo "<option value='$id'>$nome</option>" ;
                    }
                    $listamedico = Medico::listar_medico();
    
                ?>
        </select>
        <input type="hidden" name="id" value="<?=$medico["id"]?>">
            <br>
            <br>
            <button>Editar</button>
        </form>
    </div>




      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>