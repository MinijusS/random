<?php
/**
 * F-cija, tikrinanti ar skaiciaus range
 * @param $field_input siunciam ivesta laukeli
 * @param array $field parasom i formos masyvo laukelio errora
 * @param $params siunciam range min ir max
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_age_range($field_input, array &$field, array $params): bool
{
    if($field_input <= $params['min'] || $field_input >= $params['max']) {
        $field['error'] = strtr("Skaicius turi buti didesnis uz @min ir mazesnis uz @max", [
            '@min' => $params['min'],
            '@max' => $params['max']
        ]);
        return false;
    }

    return true;
}

/**
 * F-cija, tikrinanti zodzio ilguma
 * @param $field_input siunciam ivesta laukeli
 * @param array $field parasom i formos masyvo laukelio errora
 * @param $params siunciam range min ir max
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_text_length($field_input, array &$field, array $params): bool
{
    $text_length = strlen($field_input);

    if ($text_length <= $params['min'] || $text_length > $params['max']) {
        $field['error'] = strtr("Simboliu skaicius turi buti ne mazesnis uz @min ir ne didesnis uz @max", [
            '@min' => $params['min'],
            '@max' => $params['max']
        ]);

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
        if ($item['team_id'] == $field_input) {
            $field['error'] = 'Tokia komanda jau egzistuoja!';

            return false;
        }
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
            $form['error'] = 'Toks slapyvardis sitoje komandoje jau uzregistruotas!';

            return false;
        }
    }

    return true;
}