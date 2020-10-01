<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function succ_msg($msg)
{
    return '<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Sukses!</strong> '.$msg.'
            </div>';
}

function warn_msg($msg)
{
    return '<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Perhatian!</strong> '.$msg.'
            </div>';
}

function err_msg($msg)
{
    return '<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Gagal!</strong> '.$msg.'
            </div>';
}

function toRupiah($data = '')
{
    if($data <= 0 || $data == '')
    {
        return 'Rp ' . '0,-';
    }
    else
    {
        return 'Rp ' . number_format($data, 0, ',', '.') . ',-';
    }
}