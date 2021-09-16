<?php

function readData($group, $album){
    $url = returnURL($group, $album).'/+partial/tracks';
    $data = file_get_contents($url);

    $DOM = new DOMDocument();
    $DOM->loadHTML($data);

    $Header = $DOM->getElementsByTagName('th');
    $Detail = $DOM->getElementsByTagName('td');

//#Get header name of the table
    foreach($Header as $NodeHeader)
    {
        $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
    }
//print_r($aDataTableHeaderHTML); die();

//#Get row data/detail table without header name as key
    $i = 0;
    $j = 0;
    foreach($Detail as $sNodeDetail)
    {
        $rows[$j][] = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', trim($sNodeDetail->textContent));
        $i = $i + 1;
        $j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
    }

    return $rows;
}

function returnURL($group, $album){
    return 'https://www.last.fm/fr/music/'. str_replace(" ", "+", $group) .'/'. str_replace(" ", "+", $album);
}

?>