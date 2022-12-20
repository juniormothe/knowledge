<?php
require 'simplehtmldom/simple_html_dom.php';

$html = file_get_html('https://filmesviatorrents.net/?s=one+piece');

$results = $html->find('.blog-view');

$arrayResults = array();
$key = 0;

foreach ($results as $value) {
    $arrayResults[$key]['title'] = $value->find('.entry-header h2 a', 0)->plaintext;
    $arrayResults[$key]['link'] = $value->find('.entry-header h2 a', 0)->attr['href'];
    $arrayResults[$key]['date'] = $value->find('.updated', 0)->plaintext;
    $arrayResults[$key]['image'] = $value->find('.alignleft img', 0)->attr['src'];
    $key++;
}

echo '<table style="width: 100%;">';
foreach ($arrayResults as $value) {
    echo '
    <tr>
        <td style="width: 1px;">
            <img src="' . $value['image'] . '">
        </td>
        <td style="padding-left: 10px;">
            '.$value['title'].'<hr>
            '.$value['date'].'<hr>
            <a target="_BLANK" href="'.$value['link'].'">Download</a>
        </td>
    </tr>
    <tr><td><br><br></td><td></td></tr>
    ';
}
echo '</table>';
