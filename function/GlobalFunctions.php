<?php
function varDump($array)
{
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}

function googleIcon(string $codePoint, string $size = null, string $color = null)
{
    if (empty($size)) {
        $size = 'sm';
    }
    $sizeIcon = [
        's' => 'style="font-size:13px;"',
        'xs' => 'style="font-size:15px;"',
        'sm' => 'style="font-size:20px;"',
        'md' => 'style="font-size:25px;"',
        'lg' => 'style="font-size:30px;"',
        'xl' => 'style="font-size:35px;"'
    ];
    echo '<i class="material-icons text-' . $color . '" ' . $sizeIcon[$size] . '>&#x' . $codePoint . ';</i>';
}

function classGoogleIcon(string $codePoint, string $size = null, string $color = null)
{
    if (empty($size)) {
        $size = 'sm';
    }
    $sizeIcon = [
        's' => 'style="font-size:13px;"',
        'xs' => 'style="font-size:15px;"',
        'sm' => 'style="font-size:20px;"',
        'md' => 'style="font-size:25px;"',
        'lg' => 'style="font-size:30px;"',
        'xl' => 'style="font-size:35px;"'
    ];
    return '<i class="material-icons text-' . $color . '" ' . $sizeIcon[$size] . '>&#x' . $codePoint . ';</i>';
}

function nameMonth($month = null)
{
    $nameMonth = ['01' => 'janeiro', '02' => 'fevereiro', '03' => 'março', '04' => 'abril', '05' => 'maio', '06' => 'junho', '07' => 'julho', '08' => 'agosto', '09' => 'setembro', '10' => 'outubro', '11' => 'novembro', '12' => 'dezembro'];
    if (!empty($month)) {
        return $nameMonth[$month];
    } else {
        return $nameMonth;
    }
}

function nameWeek($week)
{
    $nameWeek = ['0' => 'domingo', '1' => 'segunda', '2' => 'terça', '3' => 'quarta', '4' => 'quinta', '5' => 'sexta', '6' => 'sábado'];
    return $nameWeek[$week];
}

function dateStartMonth()
{
    return date('Y-m-01');
}

function dateEndtMonth()
{
    return date('Y-m-') . cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
}

function dateBrazilianPattern($date)
{
    return date('d/m/Y',  strtotime($date));
}

function dateTimeBrazilianPattern($dateTime)
{
    return date('d/m/Y H:i:s',  strtotime($dateTime));
}

function calcutateDays($dateStart, $dateEnd)
{
    $dateStart = new DateTime($dateStart);
    $dateEnd = new DateTime($dateEnd);
    $calcutateDays = $dateStart->diff($dateEnd);
    return $calcutateDays->days;
}

function calcutateAge($birthday)
{
    $birthdayObject = new DateTime(date("Y-m-d", strtotime($birthday)));
    $nowObject = new DateTime();
    $diff = $birthdayObject->diff($nowObject);
    return $diff->y;
}

function selectedForm($value1, $value2)
{
    if ($value1 == $value2) {
        return 'selected';
    }
}

function actionButton($value1, $value2)
{
    if ($value1 == $value2) {
        return 'active';
    }
}
