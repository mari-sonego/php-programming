<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <nav class="menu navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="./index.php">Home <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Consultoriop.php">Consultorio <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Medicop.php">Médico <span class="sr-only"></span></a>
        <a class="nav-item nav-link active" href="./Pacientep.php">Paciente <span class="sr-only"></span></a>
        </div>
    </div>
    </nav>

    <h1>Consulta</h1>


    <?php
       require_once("./config/utils.php");
       require_once("./model/Paciente.php");
       require_once("./model/Consulta.php");
       require_once("./model/Medico.php");
       
       // verifica se eu to tentando fazer o cadastro de alguma coisa
       if(isMetodo('POST')){
        if(parametrosValidos($_POST, ["data","hora","id_medico", "id_paciente"])){

            $data = $_POST["data"];
            $hora = $_POST["hora"];
            $id_medico = $_POST["id_medico"];
            $id_paciente = $_POST["id_paciente"];

            $datahora = $data . ' ' . $hora;

            $agora = date("Y-m-d h:i:sa");
            $flag = false;

            if ($datahora < $agora) {
                $flag = true;
            }

            if($flag){
                $message = "Essa data já passou!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else{
                $res = Consulta::adicionarConsulta($data,$hora, $id_medico,$id_paciente);

                if($res){
                    $message = "Consulta agendada com sucesso!!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
        
       }

       
       
       }

       function deletar($id){
        try{
            $conexao = Conexao::getConexao(); 
            $stmt = $conexao ->prepare("SELECT * FROM consulta where id =?"); 
            $stmt->execute(["$id"]); 

            if($stmt -> fetchColumn() > 0){ 
                return true;
            }else{
                return false;
            }
        
        } catch(Exception $e){
            echo $e -> getMessage();
            exit;
        }
    }
       $listaconsulta = Consulta :: listar();
       $listamedico = Medico :: listar_medico();
       $listapaciente = Paciente :: listar_paciente();
       
     ?>

<div class="bloco1">
    <h2>Cadastro da consulta</h2>
        <form method="POST">
            <p>Digite a data da consulta</p>
            <input type="date" name="data" required>
            <p>Digite o horário da consulta</p>
            <input type="time" name="hora" required>
            <p>Selecione o nome do médico</p>
            <select name="id_medico">
                <?php
                    foreach($listamedico as $medico){
                        $id = $medico['id'];
                        $nome = $medico['nome'];
                        echo "<option value='$id'>$nome</option>" ;
                    }



                ?>
            </select>
            <p>Selecione o nome do paciente</p>
            <select name="id_paciente">
                <?php
                    foreach($listapaciente as $paciente){
                        $id = $paciente['id'];
                        $nome = $paciente['nome'];
                        echo "<option value='$id'>$nome</option>" ;
                    }



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
            <th>Data</th>
            <th>Hora</th>
            <th>id do médico</th>
            <th>id do paciente</th>
        </thead>
        <tbody>
            <?php
                for($i = 0; $i < count($listaconsulta); $i++){
                    echo"<tr>";
                    echo "<td>" . $listaconsulta[$i]["data"] . "</td>";
                    echo "<td>" . $listaconsulta[$i]["hora"] . "</td>";
                    echo "<td>" . $listaconsulta[$i]["id_medico"] . "</td>";
                    echo "<td>" . $listaconsulta[$i]["id_paciente"] . "</td>";
                    echo "<td><a href='editarConsulta.php?id=" . $listaconsulta[$i]["id"] ."'><button>Editar</button></a></td>";
                    echo "<td><a href='deletarConsulta.php?id=" . $listaconsulta[$i]["id"] ."'><button>Deletar</button></a></td>";
                    echo"</tr>";
                    echo"</tr>";
                }
            ?>
        </tbody>
  
     </table>
</div>

<div class="bloco2">

     <h2>Consultas marcadas para hoje!!</h2>
        <?php
        $data = date('Y-m-d');
        $resp = Consulta :: datas($data);
        ?>
        <table class="table table-striped table-hover container-sd">
        <thead>
            <th>Data</th>
            <th>id do médico</th>
            <th>id do paciente</th>
        </thead>
        <tbody>
            <?php
                for($i = 0; $i < count($resp); $i++){
                    echo"<tr>";
                    echo "<td>" .$resp[$i]["data"] . "</td>";
                    echo "<td>" . $resp[$i]["id_medico"] . "</td>";
                    echo "<td>" . $resp[$i]["id_paciente"] . "</td>";
                    echo"</tr>";
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