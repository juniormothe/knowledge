<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Validate
{
    public function rescueId($view, $table)
    {
        $Read = new \App\Models\Helpers\Read();
        $Read->fullRead("SELECT id FROM " . $table . " WHERE (view='" . $view . "') LIMIT 1");
        if ($Read->getResultado()) {
            $rescueId = $Read->getResultado();
            return $rescueId[0]['id'];
        } else {
            return 0;
        }
    }

    public function email($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkDataBase($tabela, $column, $value, $id = null)
    {
        if (strlen($id) > 0) {
            $checkDataBaseId = " AND (id<>'" . $id . "') ";
        } else {
            $checkDataBaseId = "";
        }
        $Read = new \App\Models\Helpers\Read();
        $Read->fullRead("SELECT id FROM " . $tabela . " WHERE (" . $column . "='" . $value . "') " . $checkDataBaseId . " LIMIT 1");
        if ($Read->getResultado()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function colorErroForm(array $rrayData, $name, $type = null)
    {
        if (isset($rrayData['erroForm'][$name])) {
            if (empty($type)) {
                return 'is-invalid';
            } else {
                return 'style="color: red;"';
            }
        }
    }

    public function textErroForm(array $rrayData, $name, $type = null)
    {
        if (isset($rrayData['erroForm'][$name])) {
            if (empty($type)) {
                return '<div class="invalid-feedback">' . $rrayData['erroForm'][$name] . '</div>';
            } else {
                return '<div class="col-lg-12 text-center mb-3"><small>' . $rrayData['erroForm'][$name] . '</small></div>';
            }
        }
    }

    public function textErroCheck(array $rrayData, $name)
    {
        if (isset($rrayData['erroForm'][$name])) {
            return '<small class="small" style="color: #c4183c">' . $rrayData['erroForm'][$name] . '</small>';
        }
    }

    public function valueForm(array $rrayData, $name, $value = null)
    {
        if (isset($rrayData['form'][$name])) {
            return $rrayData['form'][$name];
        } else {
            return $value;
        }
    }

    public function selectedForm(array $rrayData, $name, $valueForm, $valueDataBase = null)
    {
        if (isset($rrayData['form'][$name])) {
            if ("" . strval($rrayData['form'][$name]) . "" == "" . strval($valueForm) . "") {
                return 'selected';
            }
        } else {
            if (strlen($valueDataBase) > 0) {
                if ("" . strval($valueForm) . "" == "" . strval($valueDataBase) . "") {
                    return 'selected';
                }
            }
        }
    }

    public function checkedForm(array $rrayData, $name, $valueForm, $valueDataBase = null)
    {
        if (isset($rrayData['form'][$name])) {
            if ("" . strval($rrayData['form'][$name]) . "" == "" . strval($valueForm) . "") {
                return 'checked';
            }
        } else {
            if (strlen($valueDataBase) > 0) {
                if ("" . strval($valueForm) . "" == "" . strval($valueDataBase) . "") {
                    return 'checked';
                }
            }
        }
    }

    public function emailCheckInset($email, $tabela)
    {
        return $this->checkDataBase($tabela, "email", $email);
    }

    public function emailCheckEdit($email, $tabela, $id)
    {
        return $this->checkDataBase($tabela, "email", $email, $id);
    }

    public function emailCheck($email, $tabela, $id = null)
    {
        return $this->checkDataBase($tabela, "email", $email, $id);
    }

    public function cpfCheckInset($cpf, $tabela)
    {
        return $this->checkDataBase($tabela, "cpf", $cpf);
    }

    public function cpfCheckEdit($cpf, $tabela, $id)
    {
        return $this->checkDataBase($tabela, "cpf", $cpf, $id);
    }

    public function nameCheck($name, $tabela, $id = null)
    {
        $Slug = new \App\Models\Helpers\Slug();
        return $this->checkDataBase($tabela, "slug", $Slug->nomeSlug($name), $id);
    }

    public function cnpjCheck($cnpj, $tabela, $id = null)
    {
        return $this->checkDataBase($tabela, "cnpj", $cnpj, $id);
    }
}
