<?php

    require_once(__DIR__ . "/../config/Conexao.php");    

    class Consulta{
        public static function adicionarConsulta($data,$hora, $id_medico,$id_paciente){
            try{

                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("insert into Consulta(data,hora,id_medico,id_paciente) values (?,?,?,?)");

                $stmt->execute([$data,$hora, $id_medico,$id_paciente]);

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

        public static function listar(){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT * FROM consulta ORDER BY id"); 
                $stmt->execute(); 

                return $stmt->fetchAll(); 
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function editar($id,$data,$hora,$id_medico, $id_paciente){
            try{

                $conexao = Conexao::getConexao();
                $stmt = $conexao ->prepare("UPDATE consulta SET data = :p2, hora = :p3, id_medico = :p4, id_paciente = :p5 where id = :p1 "); 
                $stmt->execute([
                    "p5" => $id_paciente,
                    "p3" => $hora,
                    "p4" => $id_medico,
                    "p2" => $data,
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
                $stmt = $conexao ->prepare("SELECT COUNT(*) FROM consulta where id =?"); 
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
                $stmt = $conexao ->prepare("SELECT * FROM consulta where id =?"); 
                $stmt->execute(["$id"]); 

                return $stmt -> fetchAll()[0];
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function datas($data){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT * FROM consulta where data =? ORDER BY hora"); 
                $stmt->execute(["$data"]); 

                return $stmt -> fetchAll();
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function deletar($id){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("DELETE FROM consulta where id =?"); 
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