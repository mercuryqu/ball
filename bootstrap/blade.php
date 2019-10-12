<?php

/**
 * show error html
 */
if (! function_exists('show_error_html')) {
    function show_error_html()
    {
        return '<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> :message</label>';
    }
}

/**
 * show star count
 */
if (! function_exists('make_star')) {
    function make_star($star_count = 5)
    {
        $star = '';
        for ($i=0; $i < intval($star_count); $i++)
        {
            $star .= '<li>★</li>';
        }

        return $star;
    }
}