<?php

    require_once(__DIR__ . "/../config/Conexao.php");   

    class Medico
    {
        public static function adicionarMedico($nome, $crm, $telefone, $id_consutorio){
            try{

                $conexao = Conexao::getConexao(); 
                $stmt = $conexao -> prepare("insert into Medico(nome,crm,telefone,id_consutorio) values (?,?,?,?)"); 
                $stmt->execute([$nome,$crm, $telefone, $id_consutorio]); 
                if($stmt->rowCount()){
                    return true;
                } else{
                    return false; 
                }

            }catch(Exception $e){
                echo $e -> getMessage();
                exit; 

            }
        } 

        public static function listar_medico(){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT * FROM medico ORDER BY id"); 
                $stmt->execute(); 

                return $stmt->fetchAll(); 
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function editar($id,$nome,$crm, $telefone, $id_consutorio){
            try{

                $conexao = Conexao::getConexao();
                $stmt = $conexao ->prepare("UPDATE medico SET nome = :p2,id_consutorio = :p5, telefone = :p4, crm= :p3 where id = :p1 "); 
                $stmt->execute([
                    "p4" => $telefone,
                    "p3" => $crm,
                    "p2" => $nome,
                    "p5" => $id_consutorio,
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
                $stmt = $conexao ->prepare("SELECT COUNT(*) FROM medico where id =?"); 
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
                $stmt = $conexao ->prepare("SELECT * FROM medico where id =?"); 
                $stmt->execute(["$id"]); 

                return $stmt -> fetchAll()[0];
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function qnt(){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT COUNT(*) FROM medico group by id_consultorio"); //conta quantas pessoas existem com aquele id
                $stmt->execute(); 

                return $stmt -> fetchAll();
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function deletar($id){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("DELETE FROM medico where id =?"); 
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
