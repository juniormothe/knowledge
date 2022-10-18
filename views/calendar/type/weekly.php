<?php
$Calendar = new Classe\Calendar();
$weekly = $Calendar->weekCalendar($assistant['week'], $assistant['year']);
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
    <tr>
        <?php
        if (!empty($weekly)) {
        ?>
            <td <?php echo $CalendarAssistant->actionDay($weekly[0]); ?> align="center"><small><?php echo date('d/m/Y', strtotime($weekly[0])); ?></small></td>
            <td <?php echo $CalendarAssistant->actionDay($weekly[1]); ?> align="center"><small><?php echo date('d/m/Y', strtotime($weekly[1])); ?></small></td>
            <td <?php echo $CalendarAssistant->actionDay($weekly[2]); ?> align="center"><small><?php echo date('d/m/Y', strtotime($weekly[2])); ?></small></td>
            <td <?php echo $CalendarAssistant->actionDay($weekly[3]); ?> align="center"><small><?php echo date('d/m/Y', strtotime($weekly[3])); ?></small></td>
            <td <?php echo $CalendarAssistant->actionDay($weekly[4]); ?> align="center"><small><?php echo date('d/m/Y', strtotime($weekly[4])); ?></small></td>
            <td <?php echo $CalendarAssistant->actionDay($weekly[5]); ?> align="center"><small><?php echo date('d/m/Y', strtotime($weekly[5])); ?></small></td>
            <td <?php echo $CalendarAssistant->actionDay($weekly[6]); ?> align="center"><small><?php echo date('d/m/Y', strtotime($weekly[6])); ?></small></td>
        <?php
        }
        ?>
    </tr>
</table>