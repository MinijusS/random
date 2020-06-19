<?php

use App\Pixels\Pixel;

include '../bootloader.php';
$pixels = App\App::$db->getRowsWhere('pixels');

function form_success($safe_input, &$form)
{
    $condition = [
        'x' => $safe_input['x'],
        'y' => $safe_input['y']
    ];

    $row = [
        'x' => $safe_input['x'],
        'y' => $safe_input['y'],
        'color' => $safe_input['color'],
        'email' => $_SESSION['email']
    ];

    $pixel = new Pixel($row);
    if ($existing_pixel = App\App::$db->getRowWhere('pixels', $condition)) {
        $existing_pixel_id = array_key_first($existing_pixel);
        App\App::$db->updateRow('pixels', $existing_pixel_id, $pixel->_getData());
    } else {
        App\App::$db->insertRow('pixels', $pixel->_getData());
    }

    header("Location: /");
}