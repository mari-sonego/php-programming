<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

  <nav class="menu navbar navbar-expand-lg a navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="./index.php">Menu <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultap.php">Consulta <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultoriop.php">Consultorio <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Pacientep.php">Paciente <span class="sr-only"></span></a>
        </div>
    </div>
    </nav>

    <h1>Médicos</h1>

    <?php
       require_once("./config/utils.php");
       require_once("./model/Medico.php");
       require_once("./model/Consultorio.php");
       
       //verifica se eu to tentando fazer o cadastro de alguma coisa
       if(isMetodo('POST')){
       if(parametrosValidos($_POST, ["nome","crm","telefone","id_consutorio"])){
       $nome = $_POST["nome"];
       $crm = $_POST["crm"];
       $telefone = $_POST["telefone"];
       $id_consutorio = $_POST["id_consutorio"];
       
       $res = Medico::adicionarMedico($nome, $crm, $telefone, $id_consutorio);
       if($res){
        $message = "Médico(a) cadstrado(a) com sucesso";
            echo "<script type='text/javascript'>alert('$message');</script>";    

    }
      
       
       }
       
       
       }
       $listaconsultorios = Consultorio :: listar();
       
     ?>

    <div class="bloco1">
        <h2>Cadastro de médicos</h2>
        <form method="POST">
            <p>Digite seu nome</p>
            <input type="text" name="nome" required>
            <p>Digite seu crm</p>
            <input type="text" name="crm" required>
            <p>Digite seu telefone</p>
            <input type="text" name="telefone" required>
            <p>Selecione o nome do consultório</p>
            <select name="id_consutorio">
                <?php
                    foreach($listaconsultorios as $consultorio){
                        $id = $consultorio['id'];
                        $nome = $consultorio['nome'];
                        echo "<option value='$id'>$nome</option>" ;
                    }
                    $listamedico = Medico::listar_medico();
    
                ?>
        </select>
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
                <th>CRN</th>
                <th>Telefone</th>
                <th>Id do Consultório</th>
            </thead>
    </div>
        <tbody>
            <?php
                for($i = 0; $i < count($listamedico); $i++){
                    echo"<tr>";
                    echo "<td>" . $listamedico[$i]["nome"] . "</td>";
                    echo "<td>" . $listamedico[$i]["crm"] . "</td>";
                    echo "<td>" . $listamedico[$i]["telefone"] . "</td>";
                    echo "<td>" . $listamedico[$i]["id_consutorio"] . "</td>";
                    echo "<td><a href='editarMedico.php?id=" . $listamedico[$i]["id"] ."'><button>Editar</button></a></td>";
                    echo "<td><a href='deletarMedico.php?id=" . $listamedico[$i]["id"] ."'><button>Deletar</button></a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
  
     </table>
        
       


      

    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>