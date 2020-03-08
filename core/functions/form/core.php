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
 * F-cija, kuri patikrina, ar nera tusciu langeliu
 * @param $form siunciame pacia forma, o tada ja susigraziname su &
 * @param $input siunciame prafiltruota inputa
 */
function validate_form(&$form, $input): void
{
    foreach ($input as $input_index => $field) {
        if ($field === '') {
            $form['fields'][$input_index]['errors'] = 'Prasome uzpildyt si laukeli!';
        } else {
            $form['fields'][$input_index]['value'] = $_POST[$input_index];
        }
    }
}