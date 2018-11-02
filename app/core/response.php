<?php

namespace Miniflux\Response;

function force_download($filename)
{
    header('Content-Disposition: attachment; filename="'.$filename.'"');
}

function status($status_code)
{
    $sapi_name = php_sapi_name();

    if (strpos($sapi_name, 'apache') !== false || $sapi_name === 'cli-server') {
        header('HTTP/1.0 '.$status_code);
    } else {
        header('Status: '.$status_code);
    }
}

function redirect($url, $status_code = 302)
{
    header('Location: '.$url, true, $status_code);
    exit;
}

function json(array $data, $status_code = 200)
{
    status($status_code);

    header('Content-Type: application/json');
    echo json_encode($data);

    exit;
}

function text($data, $status_code = 200)
{
    status($status_code);

    header('Content-Type: text/plain; charset=utf-8');
    echo $data;

    exit;
}

function html($data, $status_code = 200)
{
    status($status_code);

    header('Content-Type: text/html; charset=utf-8');
    echo $data;

    exit;
}

function xml($data, $status_code = 200)
{
    status($status_code);

    header('Content-Type: text/xml; charset=utf-8');
    echo $data;

    exit;
}

function raw($data, $status_code = 200)
{
    status($status_code);
    echo $data;
    exit;
}

function binary($data, $status_code = 200)
{
    status($status_code);

    header('Content-Transfer-Encoding: binary');
    header('Content-Type: application/octet-stream');
    echo $data;

    exit;
}

function csp(array $policies = array())
{
    $policies['default-src'] = "'self'";
    $values = '';

    foreach ($policies as $policy => $hosts) {
        if (is_array($hosts)) {
            $acl = '';

            foreach ($hosts as &$host) {
                if ($host === '*' || $host === "'self'" || strpos($host, 'http') === 0) {
                    $acl .= $host.' ';
                }
            }
        } else {
            $acl = $hosts;
        }

        $values .= $policy.' '.trim($acl).'; ';
    }

    header('Content-Security-Policy: '.$values);
}

function nosniff()
{
    header('X-Content-Type-Options: nosniff');
}

function xss()
{
    header('X-XSS-Protection: 1; mode=block');
}

function hsts()
{
    header('Strict-Transport-Security: max-age=31536000');
}

function xframe($mode = 'DENY', array $urls = array())
{
    header('X-Frame-Options: '.$mode.' '.implode(' ', $urls));
}
