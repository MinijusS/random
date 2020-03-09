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
 * F-cija, kuri validuoja pacia forma
 * (sukuria fieldams-formai errorus)
 * @param array $form
 * @param array $safe_input isfiltruotas post masyvas
 * @return bool
 */
function validate_form(array &$form, array $safe_input): bool
{
    $success = true;

    foreach ($form['fields'] as $field_index => &$field) {
        $field['value'] = $safe_input[$field_index];

        foreach ($field['validate'] ?? [] as $validator_index => $field_validator) {
            if (is_array($field_validator)) {
                $validator_function = $validator_index;
                $validator_params = $field_validator;

                $is_valid = $validator_function($field['value'], $field, $validator_params);
            } else {
                $validator_function = $field_validator;

                $is_valid = $validator_function($field['value'], $field);
            }
            if (!$is_valid) {
                $success = false;
                break;
            }
        }
    }

    //Dabar tikrinsim formos lygio validatorius
//    if ($success) {
        foreach ($form['validators'] ?? [] as $validator_index => $form_validator) {
            if (is_array($form_validator)) {
                $validator_function = $validator_index;
                $validator_params = $form_validator;

                $is_valid = $validator_function($safe_input, $form, $validator_params);
            } else {
                $validator_function = $form_validator;

                $is_valid = $validator_function($safe_input, $form);
            }
            if (!$is_valid) {
                $success = false;
                break;
            }
        }
//    }

    if ($success) {
        if (isset($form['callbacks']['success'])) {
            $form['callbacks']['success']($safe_input, $form);
        }
    } else {
        if (isset($form['callbacks']['fail'])) {
            $form['callbacks']['fail']($safe_input, $form);
        }
    }

    return $success;
}



