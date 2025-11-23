<?php
    require_once(__DIR__ . "/../config/Conexao.php");

    class Paciente{
        public static function adicionarPaciente($nome, $cpf, $telefone,$endereco){
            try{

                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("insert into Paciente(nome,cpf,telefone,endereco) values (?,?,?,?)");

                $stmt->execute([$nome, $cpf, $telefone,$endereco]);

                if($stmt->rowCount()){
                    return true; 
                } else{
                    return false;
                }

            }catch(Exception $e){
                echo $e -> getMessage();
                exit; // parar de executar

            }
        }

        public static function listar_paciente(){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT * FROM paciente ORDER BY id"); 
                $stmt->execute(); 

                return $stmt->fetchAll(); 
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function editar($id,$nome,$cpf, $telefone, $endereco){
            try{

                $conexao = Conexao::getConexao();
                $stmt = $conexao ->prepare("UPDATE paciente SET nome = :p2, endereco = :p5, telefone = :p4, cpf = :p3 where id = :p1 "); 
                $stmt->execute([
                    "p4" => $telefone,
                    "p3" => $cpf,
                    "p2" => $nome,
                    "p5" => $endereco,
                    "p1" => $id
                ]); 

                if($stmt->rowCount() > 0){
                    return true; 
                } else{
                    return false;
                }

            }catch(Exception $e){
                echo $e -> getMessage();
                exit;

            }
        } 

        public static function existe($id){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT COUNT(*) FROM paciente where id =?"); 
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

        public static function get($id){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT * FROM paciente where id =?"); 
                $stmt->execute(["$id"]); 

                return $stmt -> fetchAll()[0];
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function deletar($id){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("DELETE FROM paciente where id =?"); 
                $stmt->execute(["$id"]); 

                if($stmt -> fetchColumn() < 0){ 
                    return true;
                }else{
                    return false;
                }
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }


    }

?>