<?php

require_once 'simple_html_dom.php';

const URL = 'https://www.fluvius.hr/tjedni.php';

$html = file_get_html(URL);

if ($html === FALSE) {
    die('Error fetching the URL');
}

$menu = '';
foreach ($html->find('.menu-restaurant-actual > .clearfix') as $element) {
    foreach ($element->children() as $key => $childNode) {
        if ($key % 2 == 0) {
            $menu .= str_replace('<br>', ' ', trim($childNode->innertext)) . " - ";
        } else {
            $menu .= trim($childNode->innertext) . "\n";
        }
    }
}

echo $menu;