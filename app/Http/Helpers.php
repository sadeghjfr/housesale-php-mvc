<?php

function sidebarActive($url, $contain = true): string {

    if ($contain)
        return (strpos(currentUrl(), $url)) === 0 ? 'active' : '';

    else
        return currentUrl() === $url ? 'active' : '';

}

function errorClass($name): string {

    return errorExists($name) ? 'is-invalid' : '';
}

function errorText($name): string {

    return errorExists($name) ? '<div><small class="text-danger">' . error($name) . '</small></div>' : '';
}

function oldOrValue($name, $value)
{
    return empty(old($name)) ? $value : old($name);
}
