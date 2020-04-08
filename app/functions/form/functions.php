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