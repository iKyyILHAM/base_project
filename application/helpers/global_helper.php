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


if (!function_exists('encrypt_id')) {
    function encrypt_id($id) {
        $key = 'kuncirahasia'; // Ganti dengan kunci yang lebih aman
        $cipher = 'AES-256-CBC';
        $iv_length = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $encrypted_id = openssl_encrypt($id, $cipher, $key, OPENSSL_RAW_DATA, $iv);

        return urlencode(base64_encode($iv . $encrypted_id));
    }
}


if (!function_exists('decrypt_id')) {
    function decrypt_id($encrypted_id) {
        $key = 'kuncirahasia'; // Ganti dengan kunci yang lebih aman
        $cipher = 'AES-256-CBC';
        $encrypted_id = base64_decode(urldecode($encrypted_id));
        $iv_length = openssl_cipher_iv_length($cipher);
        $iv = substr($encrypted_id, 0, $iv_length);
        $encrypted_id = substr($encrypted_id, $iv_length);

        return openssl_decrypt($encrypted_id, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    }
}

