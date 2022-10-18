<?php

namespace Classe;

use PDO;
use Exception;

/**
 * Classe de conexão
 * 
 * Está classe é responsável por fazer acConexão com o banco de dados MYSQL
 * 
 * @param private $host ...
 * @param private $user ...
 * @param private $pass ...
 * @param private $dbName ...
 * @param private $connect ...
 * 
 * @method public getConn() ... 
 * @method private connect() ... 
 * 
 * @package Meus códigos
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
