<?php

namespace App\Controllers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Api
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\Helpers\CrudComplete();
    }

    public function index()
    {
        //echo "print";
    }

    public function list()
    {
        $array = $this->model->read("tarefas");
        header("Content-Type: application/jason");
        echo json_encode($array);
    }

    public function add()
    {
        if (isset($_POST['titulo'])) {
            $this->model->create("tarefas", ['status' => '0', 'titulo' => addslashes($_POST['titulo'])]);
        }
    }

    public function update()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            if (isset($_POST['status']) && !empty($_POST['status'])) {
                $this->model->update("tarefas", ['status' => addslashes($_POST['status'])], "WHERE (id='" . addslashes($_POST['id']) . "')");
            }
        }
    }

    public function delete()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $this->model->delete("tarefas", "WHERE (id='" . addslashes($_POST['id']) . "')");
        }
    }
}
