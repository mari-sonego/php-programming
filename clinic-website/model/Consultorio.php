<?php

    require_once(__DIR__ . "/../config/Conexao.php");    

    class Consultorio
    {
        public static function adicionarConsultorio($nome, $endereco){
            try{

                $conexao = Conexao::getConexao(); 
                $stmt = $conexao -> prepare("insert into consutorio(nome,endereco) values (?,?)"); 
                $stmt->execute([$nome, $endereco]); 
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

        public static function listar(){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT * FROM consutorio ORDER BY id"); 
                $stmt->execute(); 

                return $stmt->fetchAll(); 
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function existe($id){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT COUNT(*) FROM consutorio where id =?"); //conta quantas pessoas existem com aquele id
                $stmt->execute(["$id"]); 

                if($stmt -> fetchColumn() > 0){ //o fetchColumn pega a primeira coluna da primeira linha
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
                $stmt = $conexao ->prepare("SELECT * FROM consutorio where id =?"); //conta quantas pessoas existem com aquele id
                $stmt->execute(["$id"]); 

                return $stmt -> fetchAll()[0];
            
            } catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function editar($id,$nome, $endereco){
            try{

                $conexao = Conexao::getConexao();
                $stmt = $conexao ->prepare("UPDATE consutorio SET endereco = :p3, nome =:p2  where id = :p1"); 
            
                $stmt->execute([
                    "p1" => $id,
                    "p2" => $nome,
                    "p3" => $endereco
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

        public static function qnt(){
            try{
                $conexao = Conexao::getConexao(); 
                $stmt = $conexao ->prepare("SELECT * FROM consutorio where id =?"); //conta quantas pessoas existem com aquele id
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
                $stmt = $conexao ->prepare("DELETE FROM consutorio where id =?"); 
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