<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class CrudComplete
{
    private $create;
    private $read;
    private $update;
    private $delete;
    private $cryptography;
    private $pagination;
    private $log;

    public function __construct()
    {
        $this->create = new \App\Models\Helpers\Create();
        $this->read = new \App\Models\Helpers\Read();
        $this->update = new \App\Models\Helpers\Update();
        $this->delete = new \App\Models\Helpers\Delete();
        $this->cryptography = new \App\Models\Helpers\Cryptography();
        $this->pagination = new \App\Models\Helpers\Pagination();
        $this->log = new \App\Models\Helpers\Log();
    }

    public function create($Table, array $Data)
    {
        $this->create->exeCreate($Table, $Data);
        return $this->create->getResultado();
    }

    public function createFull($Table, array $Data)
    {
        $this->create->exeCreate($Table, $Data);
        if ($this->create->getResultado()) {
            $arrayView = ['view' => $this->cryptography->createViewer($Table, $this->create->getResultado())];
            $this->update->exeUpdate($Table, $arrayView, "WHERE (id='" . $this->create->getResultado() . "')");
        }
        return $this->create->getResultado();
    }

    public function read($Table, $Termo = null)
    {
        $this->read->exeRead($Table, $Termo);
        return $this->read->getResultado();
    }

    public function readFull()
    {
    }

    public function count($table, $column, $where = null)
    {
        $this->read->fullRead("SELECT COUNT(" . $column . ") AS total FROM " . $table . " " . $where . "");
        $viewCount = $this->read->getResultado();
        if (!empty($viewCount[0]['total'])) {
            return $viewCount[0]['total'];
        } else {
            return 0;
        }
    }

    public function sum($table, $column, $where = null)
    {
        $this->read->fullRead("SELECT SUM(" . $column . ") AS total FROM " . $table . " " . $where . "");
        $viewSum = $this->read->getResultado();
        if (!empty($viewSum[0]['total'])) {
            return round($viewSum[0]['total'], 2);
        } else {
            return 0;
        }
    }

    public function update($Table, array $Data, $Termo = null)
    {
        $this->update->exeUpdate($Table, $Data, $Termo);
        return $this->update->getResultado();
    }

    public function deleteUpdate($Table, $Id)
    {
        $arrayDelete = ['status' => 0];
        $this->update->exeUpdate($Table, $arrayDelete, "WHERE (id='" . $Id . "')");
        return $this->update->getResultado();
    }

    public function delete($Table, $Termo)
    {
        $this->delete->exeDelete($Table, $Termo);
        return $this->delete->getResultado();
    }

    public function log($description)
    {
        $this->log->save($description);
    }
}
