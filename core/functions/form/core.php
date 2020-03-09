<?php
/**
 * F-cija, kuris prafiltruoja visa $_POST masyva nuo blogos ivesties
 * @param array $fields sinuciame masyvo elementus
 * @return array gauname prafiltruota masyva
 */
function get_filtered_input(array $form): array
{
    $sanitized_items = [];

    foreach ($form['fields'] as $index => $item) {
        if (isset($item['filter'])) {
            $sanitized_items[$index] = $item['filter'];
        } else {
            $sanitized_items[$index] = FILTER_SANITIZE_SPECIAL_CHARS;
        }
    }

    return filter_input_array(INPUT_POST, $sanitized_items);
}

/**
 * F-cija, kuri tikrina pacia forma
 * @param $form siunciame forma, kuria naudosime
 * @param $safe_input siunciame jau prafiltruotus laukelius, pagal kuriuos tikrinsim
 */
function validate_form(&$form, $safe_input): bool
{
    $success = true;
    foreach ($safe_input as $input_index => $value) {
        $field = &$form['fields'][$input_index];
        $field['value'] = $safe_input[$input_index];
        foreach ($field['validate'] ?? [] as $validate) {
            $is_valid = $validate($value, $field);
            if (!$is_valid) {
                $success = false;
                break;
            }
        }
    }
    return $success;
}

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
 * F-cija, tikrinanti ar skaicius nevirsija 100
 * @param $field_input siunciam ivesta laukeli
 * @param $field parasom i formos masyvo laukelio errora
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_max_100($field_input, array &$field): bool
{
    if ($field_input > 100) {
        $field['error'] = 'Skaicius negali buti didesnis uz 100!';
        return false;
    }

    return true;
}


