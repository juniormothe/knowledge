<?php
class nome
{
    public function nomeSexo($nome, $sexo = null)
    {
        return $nome . " (" . $this->sexo($_SESSION['sexo']) . ")";
    }

    private function sexo($sexo)
    {
        if ($sexo == 1) {
            return "Masculino";
        } elseif ($sexo == 2) {
            return "Feminino";
        } else {
            return "-----";
        }
    }
}
