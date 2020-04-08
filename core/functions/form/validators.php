<?php
/**
 * F-cija, tikrinanti ar laukelis netuscias
 * @param $field_input siunciam ivesta laukeli
 * @param $field parasom i formos masyvo laukelio errora
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_not_empty($field_input, array &$field): bool
{
    if (empty($field_input)) {
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
 * F-cija, tikrinanti ar tokios komandos dar nera irasytos TEAMS faile
 * @param $field_input irasyta komandos reiksme laukelyje
 * @param $field
 * @return bool
 */
function validate_team($field_input, array &$field): bool
{
    $existing = file_to_array(TEAMS_FILE);
    foreach ($existing ?? [] as $item) {
        if ($item['name'] == $field_input) {
            $field['error'] = 'Tokia komanda jau egzistuoja!';

            return false;
        }
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
 * @param $value atsiusti fieldai
 * @param $form
 * @return bool
 */
function validate_player_unique(array $value, array &$form): bool
{
    $existing = file_to_array(TEAMS_FILE);
    $team_id = $value['team'];
    foreach ($existing[$team_id]['players'] ?? [] as $player) {
        if ($player['name'] == $value['username']) {
            $form['error'] = 'Toks username sitoje komandoje jau uzregistruotas!';

            return false;
        }
    }

    return true;
}