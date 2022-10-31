<?php
$Tamagotchi = new Classe\Tamagotchi();
$form = POSTT;
if (isset($form['addFood'])) {
    unset($form['addFood']);
    $Tamagotchi->addFood();
}
if (isset($form['addCare'])) {
    unset($form['addCare']);
    $Tamagotchi->addCare();
}
if (isset($form['addSleeping'])) {
    unset($form['addSleeping']);
    $Tamagotchi->addSleeping();
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4" style="padding-top: 5%;">
            <div class="row">
                <div class="col-lg-12 text-center" style="padding-bottom: 15px;">
                    <div style="position:absolute; top:0px; left:0px; padding-left: 10px">
                        <?php
                        if ($_SESSION['sleeping']['status'] == 1) {
                            echo '<b>Dormindo</b>';
                        } else {
                            if ($_SESSION['hungry']['value'] < 2) {
                                echo '<b>Fome</b><br>';
                            }
                            if ($_SESSION['sad']['value'] <= 2) {
                                echo '<b>Raiva</b><br>';
                            } elseif ($_SESSION['sad']['value'] <= 4) {
                                echo '<b>Chateado</b><br>';
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <img src="image/tamagotchi/<?php echo $_SESSION['gif']; ?>.gif" class="img-fluid">
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                    <form method="POST">
                        <button <?php echo $_SESSION['foodButton']; ?> type="submit" class="btn btn-outline-secondary btn-block btn-sm" name="addFood">Comida</button>
                    </form>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                    <form method="POST">
                        <button <?php echo $_SESSION['careButton']; ?> type="submit" class="btn btn-outline-secondary btn-block btn-sm" name="addCare">Carinho</button>
                    </form>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                    <form method="POST">
                        <button <?php echo $_SESSION['sleepingButton']; ?> type="submit" class="btn btn-outline-secondary btn-block btn-sm" name="addSleeping"><?php echo $_SESSION['sleepingButtonName']; ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<?php
if ($_SESSION['food'] > 0) {
    $_SESSION['food']--;
}
if ($_SESSION['care'] > 0) {
    $_SESSION['care']--;
}
?>