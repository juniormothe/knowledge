<?php

namespace Classe;

/**
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Scale
{
    private $dataInicial;
    private $dataFinal;
    private $listaId;

    public function __construct($dataInicial = null, $dataFinal = null)
    {
        if (!empty($dataInicial)) {
            $this->dataInicial = $dataInicial;
        } else {
            $this->dataInicial = dateStartMonth();
        }
        if (!empty($dataFinal)) {
            $this->dataFinal = $dataFinal;
        } else {
            $this->dataFinal = dateEndtMonth();
        }
        $this->listaId = $this->listaId();
    }

    public function getListaId()
    {
        return $this->listaId;
    }

    public function verificarEscala($data)
    {
        $Read = new Read();
        return $Read->viewSum("scale", "id", "WHERE (id IN (" . $this->listaId . ")) AND (scale_date LIKE '%{" . $data . "}%')");
    }

    private function listaId()
    {
        $Read = new Read();
        $Read->fullRead("SELECT id FROM scale WHERE (date_initial>='" . $this->dataInicial . "') ");
        foreach ($Read->getResultado() as $value) {
            $listaId[] = $value['id'];
        }
        if (!empty($listaId)) {
            return implode(',', $listaId);
        } else {
            return 0;
        }
    }
}
