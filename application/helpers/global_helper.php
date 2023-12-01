<?php
function dd($data, $type = "v")
{
    echo '<pre style="padding: 20px;
    background-color: #34373b;
    color: white;">';
    if ($type == 'v') {
        var_dump($data);
    }
    if ($type == 'r') {
        print_r($data);
    }
    echo '</pre>';
    die();
}
function is_active($page, $current_page)
{
    if ($page === $current_page) {
        return 'active'; 
    }
    return ''; 
}
function get_current_page()
{
    $CI =& get_instance();
    return $CI->uri->segment(1);
}
