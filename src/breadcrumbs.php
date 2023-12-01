<?php
function breadcrumb($link, $naam, $huidigePagina): string
{
    $naam = ucfirst($naam);

    if (!$huidigePagina) {
        return "<li><a href=\"$link\">$naam</a></li>";
    } else {
        return "<li>$naam</li>";
    }
}