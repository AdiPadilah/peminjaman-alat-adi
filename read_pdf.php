<?php
$data = file_get_contents('BAB-6.pdf');
preg_match_all('/BT(.+?)ET/s', $data, $matches);
$text = '';
foreach ($matches[1] as $m) {
    preg_match_all('/\(([^\)]+)\)/', $m, $strings);
    foreach($strings[1] as $s) {
        $text .= $s . ' ';
    }
}
echo substr($text, 0, 5000);
