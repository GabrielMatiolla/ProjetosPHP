<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cUsuario
 *
 * @author jairb
 */
class cUsuario {
    //put your code here
    public function inserir() {
        if(isset($_POST['salvar'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $pas = $_POST['pas'];
            
            $pdo = require '../pdo/connection.php';
            $sql = "insert into usuario (nomeUser, email, pas) values (?,?,?)";
            $sth = $pdo->prepare($sql);
            //$sth->execute([$nome,$email,$pas]);
            $sth->bindParam(1, $nome, PDO::PARAM_STR);
            $sth->bindParam(2, $email, PDO::PARAM_STR);
            $sth->bindParam(3, $pass, PDO::PARAM_STR);
            $pass = password_hash($pas, PASSWORD_DEFAULT);
            $sth->execute();
            unset($pdo);
            unset($sth);
        }
    }
    
    public function getUsuarios() {
        $pdo = require_once '../pdo/connection.php';
        $sql = "select idUser, nomeUser, email from usuario";
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        unset($sth);
        unset($pdo);
        return $result;
    }
    /**
     * Revisar este método, não esta deletando
     */
    public function deletar() {
        if(isset($_POST['deletar'])){
            $id = $_POST['idUser'];
            
            $pdo = require_once '../pdo/connection.php';
            $sql = "delete from usuario where idUser = ?";
            $sth = $pdo->prepare($sql);
            $sth->bindParam(1, $id, PDO::PARAM_INT);
            $sth->execute();
            unset($sth);
            unset($pdo);
            header("Refresh: 0");
        }
    }
}
