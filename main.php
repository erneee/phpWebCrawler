<?php

$userLink = $_GET['target'];

function crawl_page($url, $depth = 1) {
    if($depth > 0) {
        $html = file_get_contents($url, 0);

        preg_match_all('~<a.*?href="(.*?)".*?>~', $html, $matches);

        foreach($matches[1] as $newurl) {
            crawl_page($newurl, $depth - 1);
        }
       
        file_put_contents('results.txt', $html."\n\n", FILE_APPEND);
        if (strpos($url,'https://www.hostinger.com/') !== false) {
            echo 'link exist';
        } else {
            echo 'link do not exist';
}
    }
}


crawl_page($userLink, 1);




?>
