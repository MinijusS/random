<?php
/**
 * F-cija, kuri sugeneruoja formos atributus is masyvo
 * @param array $atrr siunciame atributu masyva
 * @return string gauname visus atributus sujungtus i viena teksta
 */
function html_attr(array $atrr): string
{
    $text = '';

    foreach ($atrr as $index => $item) {
        $text .= "{$index}=\"{$item}\" ";
    }

    return $text;
}

/**
 * F-cija, kuri sugeneruoja inputa
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
function input_attr(array $field, string $field_id)
{
    return html_attr(
        ($field['extras']['attr'] ?? []) +
        [
            'name' => $field_id,
            'type' => $field['type'],
            'value' => $field['value'] ?? ''
        ]);
}

/**
 * F-cija, kuri sugeneruoja textarea
 * @param array $field siunciame viena is fieldu
 * @param string $field_id siunciame jo indexo id, kuris yra toks pat kaip vardas
 * @return string graziname kita funkcija
 */
function textarea_attr(array $field, string $field_id)
{
    return html_attr(
        ($field['extras']['attr'] ?? []) +
        [
            'name' => $field_id,
        ]);
}

/**
 * F-cija, kuri sugeneruoja mygtuka
 * @param array $field siunciame viena is fieldu
 * @return string graziname kita funkcija
 */
function button_attr(array $field)
{
    return html_attr(
        ($field['extras']['attr'] ?? []) +
        [
            'name' => 'action',
            'value' => $field['value']
        ]);
}
