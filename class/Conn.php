<?php

namespace Classe;

use PDO;
use Exception;

/**
 * Classe de conexão
 * 
 * Está classe é responsável por fazer a conexão com o banco de dados MySQL
 * 
 * @param . $host Local banco de dados
 * @param . $user Nome usuário banco de dados
 * @param . $pass Senha usuário banco de dados
 * @param . $dbName Nome do banco de dados
 * @param . $connect Conexão com o banco de dados
 * 
 * @method . getConn() Retorna o parâmetro $connect
 * @method . connect() Faz a conexão com o banco de dados usando a biblioteca PDO
 * 
 * @package Aula
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Conn
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbName = "classes";
    private $connect = NULL;

    public function getConn()
    {
        return $this->connect();
    }

    private function connect()
    {
        try {
            if ($this->connect == NULL) {
                $this->connect = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->user, $this->pass);
            }
        } catch (Exception $exc) {
            echo 'Erro: ' . $exc->getMessage();
            die;
        }
    }
}
