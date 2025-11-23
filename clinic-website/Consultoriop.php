<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <nav class="menu navbar navbar-expand-lg a navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="./index.php">Menu <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultap.php">Consulta <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Medicop.php">Médico <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Pacientep.php">Paciente <span class="sr-only"></span></a>
        </div>
    </div>
    </nav>

    <h1>Consultório</h1>

    <!-- <div class="btn-group">
      <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Outras guias
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="./Medicop.php">Médico</a></li>
        <li><a class="dropdown-item" href="./Consultap.php">Consulta</a></li>
        <li><a class="dropdown-item" href="./Paciente.php">Paciente</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="./index.php">Principal</a></li>
      </ul>
    </div> -->



    <?php
       require_once("./config/utils.php");
       require_once("./model/Consultorio.php");
       
       // verifica se eu to tentando fazer o cadastro de alguma coisa
       if(isMetodo('POST')){
        if(parametrosValidos($_POST, ["nome","endereco"])){
        $nome = $_POST["nome"];
        $endereco = $_POST["endereco"];
       
        $res = Consultorio::adicionarConsultorio($nome, $endereco);
        if($res){
            $message = "Consultorio cadastrado!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        
       }
       
       }

    //    if(isMetodo("POST")){
    //     if(parametrosValidos($_POST, ["id","nome","endereco"])){
    //         $res = Consultorio :: editar($_POST["id"],$_POST["nome"],$_POST["endereco"]);
    //         if($res){
    //             echo "<p>O colsultorio " . $_POST["nome"] . " foi editado com sucesso!</p>";
    //         }else{
    //             echo"<p>Erro ao editar o consultório</p>";
    //         }
    //         die;
    //     }else{
    //         echo"<p>Erro ao editar o consultório</p>";
    //         die;
    //     }
    //}
       $listaconsultorio = Consultorio :: listar();
     ?>
     <div class="bloco1">
        <h2>Cadastro de consultórios</h2>
        <form method="POST">
            <p>Digite o nome</p>
            <input type="text" name="nome" required>
            <p>Digite o endereço</p>
            <input type="text" name="endereco" required>
            <br>
            <br>
            <button>Cadastrar</button>
        </form>
    </div>

    <div class="bloco2">
        <h2>Consultórios cadastradros</h2>
        <table class="table table-striped table-hover container-sd">
            <thead>
                <th>Nome</th>
                <th>Endereço</th>
            </thead>
            <tbody>
                <?php
                    for($i = 0; $i < count($listaconsultorio); $i++){
                        echo"<tr>";
                        echo "<td>" . $listaconsultorio[$i]["nome"] . "</td>";
                        echo "<td>" . $listaconsultorio[$i]["endereco"] . "</td>";
                        
                        echo "<td><a href='editarConsultorio.php?id=" . $listaconsultorio[$i]["id"] ."'><button>Editar</button></a></td>";
                        echo "<td><a href='deletarConsultorio.php?id=" . $listaconsultorio[$i]["id"] ."'><button>Deletar</button></a></td>";
                        echo"</tr>";
                    }
                ?>
            </tbody>
    
        </table>
    </div>

    <div class="bloco2">
        <h2>Quantidade de médicos do consultório</h2>
        <table class="table table-striped table-hover container-sd">
            <thead>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Quantidade de médicos</th>
            </thead>
            <tbody>
                <?php
                    for($i = 0; $i < count($listaconsultorio); $i++){
                        echo"<tr>";
                        echo "<td>" . $listaconsultorio[$i]["nome"] . "</td>";
                        echo "<td>" . $listaconsultorio[$i]["endereco"] . "</td>";
                        
                        echo "<td><a href='editarConsultorio.php?id=" . $listaconsultorio[$i]["id"] ."'><button>Editar</button></a></td>";
                        echo "<td><a href='deletarConsultorio.php?id=" . $listaconsultorio[$i]["id"] ."'><button>Deletar</button></a></td>";
                        echo"</tr>";
                    }
                ?>
            </tbody>
    
        </table>
     </div>
    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>