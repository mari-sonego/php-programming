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
 require_once("./model/Consultorio.php");

    if(isMetodo("GET")){
        if(parametrosValidos($_GET, ["id"])){
            if(Consultorio:: existe($_GET["id"])){
                $consultorio = Consultorio ::get($_GET["id"]);

            }else{
                echo"<p>Esse consultorio não existe!</p>";
                die;
            }

        }else{
            echo" <p> ID não foi enviado</p>";
            die;
        }
    }

    if(isMetodo("POST")){
        if(parametrosValidos($_POST, ["id","nome","endereco"])){
            $res = Consultorio :: editar($_POST["id"],$_POST["nome"],$_POST["endereco"]);
            if($res){
                echo "<div>";
                echo"<p> Consultório, " .$_POST["nome"] . " editado com sucesso </p>";
                echo"</div>";
            }else{
                echo"<p>Erro ao editar o consultório 1</p>";
            }
            die;
        }else{
            echo"<p>Erro ao editar, parâmetros inválidos</p>";
            die;
        }
    }
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
    <h2>Editar <?=$consultorio["nome"]?></h2>
    <form method="POST">
        <p>Digite seu nome</p>
        <input type="text" name="nome" value="<?=$consultorio["nome"]?>" required>
        <p>Digite seu endereço</p>
        <input type="text" name="endereco" value="<?=$consultorio["endereco"]?>" required>
        <input type="hidden" name="id" value="<?=$consultorio["id"]?>">
        <br>
        <br>
        <button>editar</button>
    </form>
</div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>     
</body>
</html>