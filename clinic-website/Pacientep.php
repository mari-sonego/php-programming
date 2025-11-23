<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paciente</title>
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
        <a class="nav-item nav-link active" href="./Consultoriop.php">Consultorio <span class="sr-only"></span></a>
        </div>
    </div>
    </nav>

    <div class="bloco1">
        <h1>Pacientes</h1>

    
    <?php
       require_once("./config/utils.php");
       require_once("./model/Paciente.php");
       
       // verifica se eu to tentando fazer o cadastro de alguma coisa
       if(isMetodo('POST')){
        if(parametrosValidos($_POST, ["nome","cpf","telefone"])){
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $telefone = $_POST["telefone"];
        $endereco = $_POST["endereco"];
       
        $res = Paciente::adicionarPaciente($nome,$cpf,$telefone,$endereco);
        if($res){
            $message = "Paciente cadastrado com sucesso!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        
       }
       
       
       }
       $listapaciente = Paciente :: listar_paciente();
     ?>


        <h2>Cadastro de pacientes</h2>
        <form method="POST">
            <p>Digite seu nome</p>
            <input type="text" name="nome" required>
            <p>Digite seu cpf</p>
            <input type="text" name="cpf" required>
            <p>Digite seu telefone</p>
            <input type="text" name="telefone" required>
            <p>Digite seu endereço</p>
            <input type="text" name="endereco" required>
            <br>
            <br>
            <button>Cadastrar</button>
        </form>
    </div>
    
    <div class="bloco2">
        <h2>Consultas cadastradras</h2>
        <table class="table table-striped table-hover container-sd">
            <thead>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Endereço</th>
            </thead>
            <tbody>
                <?php
                    for($i = 0; $i < count($listapaciente); $i++){
                        echo"<tr>";
                        echo "<td>" . $listapaciente[$i]["nome"] . "</td>";
                        echo "<td>" . $listapaciente[$i]["cpf"] . "</td>";
                        echo "<td>" . $listapaciente[$i]["telefone"] . "</td>";
                        echo "<td>" . $listapaciente[$i]["endereco"] . "</td>";
                        echo "<td><a href='editarPaciente.php?id=" . $listapaciente[$i]["id"] ."'><button>Editar</button></a></td>";
                        echo "<td><a href='deletarPaciente.php?id=" . $listapaciente[$i]["id"] ."'><button>Deletar</button></a></td>";
                        echo"</tr>";
                    }
                ?>
            </tbody>
    </div>
     </table>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>