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
    require_once("./model/Consulta.php");
    require_once("./model/Paciente.php");
    require_once("./model/Medico.php");


    if(isMetodo("POST")){
        if(parametrosValidos($_POST, ["id","data","hora","id_medico", "id_paciente"])){
            $res = Consulta :: editar($_POST["id"],$_POST["data"],$_POST["hora"],$_POST["id_medico"],$_POST["id_paciente"]);
            if($res){
                $message = "Consulta editado com sucesso";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }else{
                echo"<p>Erro ao editar a consulta</p>";
            }
            // die;
        }else{
            echo"<p>Erro ao editar a consulta, parâmetros inválidos</p>";
            die;
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
    if(Consulta:: existe($_GET["id"])){
        $consulta = Consulta ::get($_GET["id"]);
    }
$listamedico = Medico :: listar_medico();
$listapaciente = Paciente :: listar_paciente();

?>



<nav class="menu1 navbar navbar-expand-lg a navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="./index.php">Menu <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultap.php">Consulta <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Medicop.php">Médico <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultoriop.php">Consultorio <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Pacientep.php">Paciente <span class="sr-only"></span></a>
        </div>
    </div>
    </nav>

    <div class="bloco1">
        <h2>Editar <?=$consulta["data"]?></h2>
        <form method="POST">
            <p>Digite a data da consulta</p>
            <input type="date" name="data" value ="<?=$consulta["data"]?>" required>
            <p>Digite o horário da consulta</p>
            <input type="time" name="hora" value ="<?=$consulta["hora"]?>" required>
            <p>Selecione o nome do médico</p>
            <select name="id_medico" value = "<?=$consulta["id_medico"]?>">
                <?php
                    foreach($listamedico as $medico){
                        $id = $medico['id'];
                        $nome = $medico['nome'];
                        echo "<option value='$id'>$nome</option>" ;
                    }



                ?>
            </select>
            <p>Selecione o nome do paciente</p>
            <select name="id_paciente" <?=$consulta["id_paciente"]?>>
                <?php
                    foreach($listapaciente as $paciente){
                        $id = $paciente['id'];
                        $nome = $paciente['nome'];
                        echo "<option value='$id'>$nome</option>" ;
                    }



                ?>
            </select>
            <input type="hidden" name="id" value="<?=$consulta["id"]?>">
            <br>
            <br>
            <a href='index.php'><button>Editar</button></a>
        </form>
    </div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>