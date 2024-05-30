<?php
$url = 'https://www.google.com/maps/place/Tensho+-+Brazilian+Jiu-Jitsu+%26+Thai+boxing/@53.5596689,9.9576484,17z/data=!3m1!5s0x47b18f6847455441:0xf7e566b41ba5dd3b!4m8!3m7!1s0x47b18f60d95e78b5:0x9606a83a17761139!8m2!3d53.5596689!4d9.9602233!9m1!1b1!16s%2Fg%2F1tf2342q?entry=ttu';
$content = file_get_contents($url);
// convert text to html
// print_r($content);
// check if content has jftiEf
if (strpos($content, 'jftiEf') !== false) {
    echo 'true';
} else {
    echo 'false';

}
$doc = new DOMDocument();
$doc->loadHTML($content);
$xpath = new DOMXPath($doc);
// print_r($doc);
// get all divs with class jftiEf
$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' jftiEf ')]");

foreach ($elements as $element) {
    echo $element->nodeValue;
}
