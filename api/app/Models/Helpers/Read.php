<?php

namespace App\Models\Helpers;

use PDO;
use Exception;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Read extends Conn
{

    private $Select;
    private $Values;
    private $Resultado;
    private $Query;
    private $Conn;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function exeRead($Tabela, $Termos = null, $ParseString = null)
    {
        if (!empty($ParseString)) {
            parse_str($ParseString, $this->Values);
        }
        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
        $this->exeInstrucao();
    }

    public function fullRead($Query, $ParseString = null)
    {
        $this->Select = (string) $Query;
        if (!empty($ParseString)) {
            parse_str($ParseString, $this->Values);
        }
        $this->exeInstrucao();
    }

    public function listRead($Query, $pageLimit, $subQuery = null)
    {
        $listRead['numResult'] = 0;
        $listRead['listResult'] = NULL;
        $listRead['pgResult'] = NULL;
        $Pagination = new \App\Models\Helpers\Pagination();
        $pg = $Pagination->verificPg();

        $countList = explode(" FROM ", $Query);
        $countList = explode(" ORDER BY ", $countList[1]);
        $countList = "SELECT COUNT(*) AS nun_result FROM " . $countList[0];
        if (empty($subQuery)) {
            $this->fullRead($countList);
        } else {
            $this->fullRead($subQuery);
        }
        $listRead['numResult'] = $this->getResultado();
        if (empty($listRead['numResult'][0]['nun_result'])) {
            $listRead['numResult'] = 0;
        } else {
            $listRead['numResult'] = $listRead['numResult'][0]['nun_result'];
        }

        $numPaginas = ceil($listRead['numResult'] / $pageLimit);
        $inicio = ($pageLimit * $pg) - $pageLimit;

        $this->fullRead($Query . " LIMIT " . $inicio . "," . $pageLimit . "");
        $listRead['listResult'] = $this->getResultado();

        $listRead['pgResult'] = $Pagination->paginationView($numPaginas);

        return $listRead;
    }

    public function viewSum($table, $column, $where = null)
    {
        $this->fullRead("SELECT SUM(" . $column . ") AS total FROM " . $table . " " . $where . "");
        $viewSum = $this->getResultado();
        if (!empty($viewSum[0]['total'])) {
            return round($viewSum[0]['total'], 2);
        } else {
            return 0;
        }
    }

    public function viewCount($table, $column, $where = null)
    {
        $this->fullRead("SELECT COUNT(" . $column . ") AS total FROM " . $table . " " . $where . "");
        $viewCount = $this->getResultado();
        if (!empty($viewCount[0]['total'])) {
            return $viewCount[0]['total'];
        } else {
            return 0;
        }
    }

    private function exeInstrucao()
    {
        $this->conexao();
        try {
            $this->getIntrucao();
            $this->Query->execute();
            $this->Resultado = $this->Query->fetchAll();
        } catch (Exception $ex) {
            $this->Resultado = null;
        }
    }

    private function conexao()
    {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Select);
        $this->Query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getIntrucao()
    {
        if ($this->Values) {
            foreach ($this->Values as $Link => $Valor) {
                if ($Link == 'limit' || $Link == 'offset') {
                    $Valor = (int) $Valor;
                }
                $this->Query->bindValue(":{$Link}", $Valor, (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
