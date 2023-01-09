<?php

namespace Core;

class Controller
{

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getRequestData()
    {
        switch ($this->getMethod()) {
            case 'GET':
                return $_GET;
                break;
            case 'PUT':
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $data);
                return (array) $data;
                break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                if (is_null($data)) {
                    $data = $_POST;
                }
                return (array) $data;
                break;
            default:
                return array();
                break;
        }
    }

    public function retunJson(array $array)
    {
        header("Content-Type: application/json");
        echo json_encode($array);
        exit;
    }
}
