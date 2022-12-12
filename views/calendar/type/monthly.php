<?php
$Calendar = new Classe\Calendar($assistant['month'], $assistant['year']);
?>
<table class="table table-sm table-bordered">
    <tr>
        <td style="width: 14%;" align="center"><b>Domingo</b></td>
        <td style="width: 14.4%;" align="center"><b>Segunda</b></td>
        <td style="width: 14.4%;" align="center"><b>Terça</b></td>
        <td style="width: 14.4%;" align="center"><b>Quarta</b></td>
        <td style="width: 14.4%;" align="center"><b>Quinta</b></td>
        <td style="width: 14.4%;" align="center"><b>Sexta</b></td>
        <td style="width: 14%;" align="center"><b>Sábado</b></td>
    </tr>
    <?php
    foreach ($Calendar->fullCalendar() as $valueCalendar) :
    ?>
        <tr>
            <td <?php echo $CalendarAssistant->actionDay($valueCalendar[0]); ?> title="<?php echo date('d/m/Y', strtotime($valueCalendar[0])) ?>" align="center">
                <?php echo $CalendarAssistant->checkDaysMonth($assistant['month'], $valueCalendar[0], 'd'); ?>
            </td>
            <td <?php echo $CalendarAssistant->actionDay($valueCalendar[1]); ?> title="<?php echo date('d/m/Y', strtotime($valueCalendar[1])) ?>" align="center">
                <?php echo $CalendarAssistant->checkDaysMonth($assistant['month'], $valueCalendar[1], 'd'); ?>
            </td>
            <td <?php echo $CalendarAssistant->actionDay($valueCalendar[2]); ?> title="<?php echo date('d/m/Y', strtotime($valueCalendar[2])) ?>" align="center">
                <?php echo $CalendarAssistant->checkDaysMonth($assistant['month'], $valueCalendar[2], 'd'); ?>
            </td>
            <td <?php echo $CalendarAssistant->actionDay($valueCalendar[3]); ?> title="<?php echo date('d/m/Y', strtotime($valueCalendar[3])) ?>" align="center">
                <?php echo $CalendarAssistant->checkDaysMonth($assistant['month'], $valueCalendar[3], 'd'); ?>
            </td>
            <td <?php echo $CalendarAssistant->actionDay($valueCalendar[4]); ?> title="<?php echo date('d/m/Y', strtotime($valueCalendar[4])) ?>" align="center">
                <?php echo $CalendarAssistant->checkDaysMonth($assistant['month'], $valueCalendar[4], 'd'); ?>
            </td>
            <td <?php echo $CalendarAssistant->actionDay($valueCalendar[5]); ?> title="<?php echo date('d/m/Y', strtotime($valueCalendar[5])) ?>" align="center">
                <?php echo $CalendarAssistant->checkDaysMonth($assistant['month'], $valueCalendar[5], 'd'); ?>
            </td>
            <td <?php echo $CalendarAssistant->actionDay($valueCalendar[6]); ?> title="<?php echo date('d/m/Y', strtotime($valueCalendar[6])) ?>" align="center">
                <?php echo $CalendarAssistant->checkDaysMonth($assistant['month'], $valueCalendar[6], 'd'); ?>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
</table>