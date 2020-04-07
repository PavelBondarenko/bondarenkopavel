<?php
function smile($emodzi)
{
    return preg_replace(
        [
            '/\:-{0,1}\)/',
            '/\:-{0,1}\(/'
        ],
        [
            '😀',
            '😭'
        ],
        $emodzi
    );
}
function censor($text)
{
    return  preg_match('/(дурак|редиска)/iu', $text) ? false : true;
}