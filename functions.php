<?php

function truncateString($string, $maxLength)
{
    if (strlen($string) > $maxLength) {
        $truncatedString = substr($string, 0, $maxLength) . '...';
    } else {
        $truncatedString = $string;
    }
    return $truncatedString;
}

?>