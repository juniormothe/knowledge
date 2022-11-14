<?php

namespace Classe\assistant;

/**
 * Classe de calendário assistente
 * 
 * Está classe é responsável auxiliar a classe Calendário
 * 
 * @param private $type ...
 * @param private $year ...
 * @param private $month ...
 * @param private $week ...
 * 
 * @method public get() ... 
 * @method public checkDaysMonth() ... 
 * @method public routeWeek() ... 
 * @method public actionDay() ... 
 * @method private checkType() ... 
 * @method private checkYear() ... 
 * @method private checkMonth() ... 
 * @method private checkWeek() ... 
 * @method private checkDaysMonthType() ... 
 * @method private routeWeekTotal() ...     
 * 
 * @package Meus códigos
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class ScaleAssistant
{
    public function validarData($nome, $tipo)
    {
        switch ($tipo) {
            case 0:
                if (isset(GETT[$nome])) {
                    return GETT[$nome];
                } else {
                    return date('Y-m-d');
                }
                break;
            case 1:
                if (isset(GETT[$nome])) {
                    return GETT[$nome];
                } else {
                    return dateStartMonth();
                }
                break;
            case 2:
                if (isset(GETT[$nome])) {
                    return GETT[$nome];
                } else {
                    return dateEndtMonth();
                }
                break;
            default:
                if (isset(GETT[$nome])) {
                    return GETT[$nome];
                } else {
                    return date('Y-m-d');
                }
                break;
        }
    }

    public function diaSemana($data)
    {
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
        return $diasemana[date('w', strtotime($data))];
    }
}
