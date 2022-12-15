<?php
$array = ['nome' => 'Junior', 'idade' => 50];
////
if (isset($array['idade'])) {
    $idade = $array['idade'];
} else {
    $idade = 0;
}
////
$idade = (isset($array['idade'])) ? $array['idade'] : 0;
////
$idade = $array['idade'] ?? 0;
