<?php
$ScaleAssistant = new Classe\assistant\ScaleAssistant();
$data['inicial'] = $ScaleAssistant->validarData('dataInicial', 1);
$data['final'] = $ScaleAssistant->validarData('dataFinal', 2);
//
$Calendar = new Classe\Calendar('10', '2022');
$Scale = new Classe\Scale($data['inicial']);
$listaId = $Scale->getListaId();

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form>
                <table class="table table-sm">
                    <tr>
                        <td></td>
                        <td width="1px">
                            <input class="form-control form-control-sm" type="date" name="dataInicial" value="<?php echo $data['inicial']; ?>">
                        </td>
                        <td width="1px">
                            <input class="form-control form-control-sm" type="date" name="dataFinal" value="<?php echo $data['final']; ?>">
                        </td>
                        <td width="1px">
                            <button class="btn btn-outline-secondary btn-sm" type="submit"><?php googleIcon('eb7b', 'xs'); ?></button>
                        </td>
                    </tr>
                </table>
            </form>
            <table class="table table-sm table-bordered">
                <tr>
                    <td style="width: 1px;" align="center"><b>Data</b></td>
                    <td style="width: 1px;" align="center"><b>Semana</b></td>
                    <td align="center"><b>---------</b></td>
                </tr>
                <?php
                $dataExibir = $data['inicial'];
                for ($i = 0; $i <= (calcutateDays($data['inicial'], $data['final'])); $i++) :
                ?>
                    <tr>
                        <td align="center"><?php echo date('d/m/Y', strtotime($dataExibir)); ?></td>
                        <td align="center"><?php echo $ScaleAssistant->diaSemana($dataExibir); ?></td>
                        <td align="center">
                            <?php
                            googleIcon('e7fd', 'xs');
                            echo " " . $Scale->verificarEscala($dataExibir);
                            ?>
                        </td>
                    </tr>
                <?php
                    $dataExibir = date('Y-m-d', strtotime('+1 days', strtotime($dataExibir)));
                endfor;
                ?>
            </table>


        </div>
    </div>
</div>