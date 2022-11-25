<?php

namespace Classe;

/**
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Form
{
    private $form;
    private array $elements;

    public function __construct($name, array $parameters = null)
    {
        $form = ' name="' . $name . '" ' . $this->checkAddParameters($parameters) . '';
        $this->form = $form;
    }

    public function addInput($label, $type, $name, array $parameters = null)
    {
        $addInput = '<div class="col-lg-' . $this->checkSizeParameters($parameters) . ' mb-3">';
        $addInput .= '<label for="name"><b>' . $label . $this->checkRequiredParameters($parameters) . '</b></label>';
        $addInput .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" ' . $this->checkAddParameters($parameters) . '>';
        $addInput .= '</div>';
        $this->elements[] = $addInput;
    }

    public function addSelect()
    {
    }

    public function addCheckBox()
    {
    }

    public function addRadio()
    {
    }

    public function addTextarea()
    {
    }

    public function addButton()
    {
    }

    public function renderForm()
    {
        $renderForm = '<form ' . $this->form . '><div class="row">';
        if (!empty($this->elements)) {
            foreach ($this->elements as $valueElements) {
                if (!empty($valueElements)) {
                    $renderForm .= $valueElements;
                }
            }
        }
        $renderForm .= '</div></form>';
        echo $renderForm;
    }

    private function checkTypeForm($parameters)
    {
        $size = 12;
        if (isset($parameters['size'])) {
            $size = $parameters['size'];
        }
        return $size;
    }

    private function checkSizeParameters($parameters)
    {
        $size = 12;
        if (isset($parameters['size'])) {
            $size = $parameters['size'];
        }
        return $size;
    }

    private function checkRequiredParameters($parameters)
    {
        if (isset($parameters['required'])) {
            return ' *';
        }
    }

    private function checkAddParameters($parameters)
    {
        $addParameters = '';
        unset($parameters['size'], $parameters['required']);
        if (!empty($parameters)) {
            foreach ($parameters as $keyParameter => $valueParameter) {
                if ($keyParameter == "required") {
                    $addParameters .= ' ' . $keyParameter . '';
                } else {
                    $addParameters .= ' ' . $keyParameter . '="' . $valueParameter . '"';
                }
            }
        }
        return $addParameters;
    }
}
