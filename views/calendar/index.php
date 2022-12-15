<?php
$CalendarAssistant = new Classe\assistant\CalendarAssistant();
$assistant = $CalendarAssistant->get();
$weekly = $CalendarAssistant->routeWeek($assistant['week'], $assistant['year']);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-8 mb-3 pt-3">
                    <?php if ($assistant['type'] == 1) { ?>
                        <form>
                            <input type="hidden" name="type" value="<?php echo $assistant['type']; ?>">
                            <table>
                                <tr>
                                    <td>
                                        <select class="form-control form-control-sm" name="month">
                                            <?php
                                            foreach (nameMonth() as $keyMonth => $valueMonth) {
                                                echo '<option value="' . $keyMonth . '" ' . selectedForm($keyMonth, $assistant['month']) . '>' . ucwords($valueMonth) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm" name="year">
                                            <?php
                                            for ($i = 2020; $i <= 2030; $i++) {
                                                echo '<option value="' . $i . '" ' . selectedForm($i, $assistant['year']) . '>' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-secondary btn-sm" type="submit"><?php googleIcon('eb7b', 'xs'); ?></button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    <?php } else { ?>
                        <form>
                            <input type="hidden" name="type" value="<?php echo $assistant['type']; ?>">
                            <table>
                                <tr>
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm" href="?type=<?php echo $assistant['type']; ?>&week=<?php echo $weekly['previous']; ?>&year=<?php echo $weekly['yearPrevious']; ?>" role="button">
                                            <?php googleIcon('e5c4', 'xs'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm disabled" href="#" role="button">
                                            <?php echo "SEMANA: " . $assistant['week']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm" href="?type=<?php echo $assistant['type']; ?>&week=<?php echo $weekly['next']; ?>&year=<?php echo $weekly['yearNext']; ?>" role="button">
                                            <?php googleIcon('e5c8', 'xs'); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg-4 mb-3 pt-3 text-right">
                    <a title="Mensal" href="?type=1" class="btn btn-outline-secondary btn-sm <?php echo actionButton(1, $assistant['type']); ?>" role="button" aria-pressed="true">
                        <?php googleIcon('ebcc'); ?>
                    </a>
                    <a title="Semanal" href="?type=2" class="btn btn-outline-secondary btn-sm <?php echo actionButton(2, $assistant['type']); ?>" role="button" aria-pressed="true">
                        <?php googleIcon('e916'); ?>
                    </a>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <?php
                        if ($assistant['type'] == 2) {
                            include('views/calendar/type/weekly.php');
                        } else {
                            include('views/calendar/type/monthly.php');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>