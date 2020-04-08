<?php
/**
 * F-cija, irasanti masyva JSON formatu i nurodyta faila
 * @param array $array
 * @param $file failo pavadinimas
 * @return bool
 */
function array_to_file(array $array, $file): bool
{
    $array = json_encode($array);

    $bytes_written = file_put_contents($file, $array);

    if ($bytes_written !== FALSE) {
        return true;
    } else {
        return false;
    }
}

/**
 * F-cija, kuri nuskaito faila ir iraso i masyva elementus
 * @param string $file failo pavadinimas
 * @return bool|mixed
 */
function file_to_array(string $file)
{
    if (file_exists($file)) {
        $data = file_get_contents($file);
        if ($data !== false) {
            return json_decode($data, true);
        } else {
            return false;
        }
    } else {
        return false;
    }
}