<?php
/**
 * F-cija, tikrinanti ar laukelis netuscias
 * @param $field_input siunciam ivesta laukeli
 * @param array $field parasom i formos masyvo laukelio errora
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_not_empty($field_input, array &$field): bool
{
    if (strlen($field_input) == 0) {
        $field['error'] = 'Laukelis negali buti tuscias!';
        return false;
    }

    return true;
}

/**
 * F-cija, tikrinanti ar laukelis yra skaicius
 * @param $field_input siunciam ivesta laukeli
 * @param $field parasom i formos masyvo laukelio errora
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_is_number($field_input, array &$field): bool
{
    if (!is_numeric($field_input)) {
        $field['error'] = 'Cia turi buti skaicius!';
        return false;
    }

    return true;
}

/**
 * F-cija, tikrinanti ar skaicius yra teigiamas
 * @param $field_input siunciam ivesta laukeli
 * @param $field parasom i formos masyvo laukelio errora
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_is_positive($field_input, array &$field): bool
{
    if ($field_input <= 0) {
        $field['error'] = 'Skaicius turi buti teigiamas!';
        return false;
    }

    return true;
}

/**
 * F-cija, tikrinanti ar yra tarpas tarp zodziu
 * @param $field_input siunciam ivesta laukeli
 * @param $field parasom i formos masyvo laukelio errora
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_spaces($field_input, array &$field): bool
{
    if (!preg_match('/\s/', $field_input)) {
        $field['error'] = 'Turi ivesti ir VARDA ir PAVARDE';
        return false;
    }

    return true;
}

function validate_select($field_input, array &$field): bool
{
    $indexes = [];
    foreach ($field['options'] as $index => $option) {
        $indexes[] = $index;
    }

    if (!in_array($field_input, $indexes)) {
        $field['error'] = 'Neteisingas veiksmas';
        return false;
    }

    return true;
}

/**
 * F-cija, patikrinanti ar fieldai sutampa
 * @param array $filtered_input isfiltruotas post masyvas
 * @param array $form
 * @param array $params sutampanciu fieldu indeksu masyvas
 * @return bool
 */
function validate_fields_match(array $filtered_input, array &$form, array $params): bool
{
    $comparison_field_id = $params[0];
    $comparison = $filtered_input[$comparison_field_id];

    foreach ($params as $field_id) {
        if ($comparison != $filtered_input[$field_id]) {
            $form['error'] = 'These fields do not match!';
            $form['fields'][$field_id]['error'] = strtr('This field must match "@field"', [
                '@field' => $form['fields'][$comparison_field_id]['label']
            ]);
            return false;
        }
    }

    return true;
}


/**
 * F-cija, kuri patikrina telefono numeri
 * @param $field_input
 * @param array $field
 * @return bool
 */
function validate_phone($field_input, array &$field): bool
{
    if (!preg_match('/\+3706[0-9]{7}$/', $field_input)) {
        $field['error'] = 'Telefono numeris neteisingas!';

        return false;
    }

    return true;
}

/**
 * F-cija, kuri patikrina telefono numeri
 * @param $field_input
 * @param array $field
 * @return bool
 */
function validate_email($field_input, array &$field): bool
{
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    if (!preg_match($pattern, $field_input)) {
        $field['error'] = "Iveskite tikra el.pasta!";

        return false;
    }

    return true;
}


/**
 * F-cija, tikrinanti ar tokios komandos dar nera irasytos TEAMS faile
 * @param $field_input irasyta komandos reiksme laukelyje
 * @param $field
 * @return bool
 */
function validate_selected($field_input, array &$field): bool
{
    if ($field_input == '') {
        $field['error'] = 'Prasome pasirinkti reiksme!';

        return false;
    }

    return true;
}

/**
 * @param array $value atsiusti fieldai
 * @param array $form
 * @return bool
 */
function validate_player_unique(array $value, array &$form): bool
{
    if (App\App::$db->getRowsWhere('users', ['username' => $value['username']])) {
        $field['error'] = 'Toks slapyvardis jau uzregistruotas!';

        return false;
    }

    return true;
}

/**
 * F-cija, tikrinanti ar toks el pastas dar nera uzregistruotas
 * @param $field_input
 * @param array $field
 * @return bool
 */
function validate_email_unique($field_input, array &$field): bool
{
    if (isset($field_input['email'])) {
        if (App\App::$db->getRowsWhere('users', ['email' => $field_input['email']])) {
            $field['error'] = 'Toks el.pastas jau uzregistruotas!';

            return false;
        }
    }

    return true;
}

/**
 * @param $value
 * @param $form
 * @return bool
 */
function validate_kick(array $value, array &$form): bool
{
    $existing = file_to_array(TEAMS_FILE);
    $decoded_cookie = json_decode($_COOKIE['user'], true);
    $team_id = $decoded_cookie['team'];

    $success = false;
    foreach ($existing[$team_id]['players'] ?? [] as $player) {
        if ($player['name'] == $decoded_cookie['username']) {
            $success = true;
            break;
        }
    }
    if (!$success) {
        $form['error'] = 'Tokio zaidejo komandoje nera!';
    }

    return $success;
}


function validate_pixel(array $safe_input, array &$form): bool
{
    $conditions = [
        'x' => $safe_input['x'],
        'y' => $safe_input['y'],
    ];

    if ($pixel = App\App::$db->getRowWhere('pixels', $conditions)) {
        if ($pixel['user'] != $_SESSION['email']) {
            $form['error'] = 'Negalima overridinti ne savo pixelio!';

            return false;
        }
    }

    return true;
}