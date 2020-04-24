<?php
/**
 * F-cija, tikrinanti ar skaiciaus range
 * @param $field_input siunciam ivesta laukeli
 * @param array $field parasom i formos masyvo laukelio errora
 * @param array $params siunciam range min ir max
 * @return bool graziname erroro booleana, kuris veliau pagelbes
 */
function validate_number_range($field_input, array &$field, array $params): bool
{
    if ($field_input <= $params['min'] || $field_input >= $params['max']) {
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
 * @param array $params siunciam range min ir max
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
 * F-cija, kuri tikrina logina
 * @param $safe_input
 * @param $form
 * @return bool
 */
function validate_login(array $safe_input, array &$form)
{
    if ($user = App\App::$db->getRowWhere('users', ['email' => $safe_input['email']])) {
        if (crypt($safe_input['password'], HASH_SALT) == $user['password']) {
            // if password is correct
            $form['success'] = 'Sekmingai prisijungete!';

            return true;
        } else {
            $form['error'] = 'Slaptazodis neteisingas!';

            return false;
        }
    } else {
        $form['error'] = 'Tokio vartotojo nera!';

        return false;
    }
}

/**
 * F-cija, tikrinanti pixeli (ar toje vietoje yra esamo userio pixelis)
 * @param array $safe_input
 * @param array $form
 * @return bool
 */
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

/**
 * F-cija, tikrinanti ar prisijunges vartotojas turi pakankamai tasku
 * @param array $safe_input
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_points(array $safe_input, array &$form, array $params): bool
{
    if ($users = App\App::$db->getRowsWhere('users', ['email' => $_SESSION['email'] ?? ''])) {
        $current_user_id = array_key_first($users);
        $current_user = $users[$current_user_id];

        if ($current_user['points'] >= $params['points']) {
            //Removing points from user
            $current_user['points'] -= $params['points'];
            App\App::$db->updateRow('users', $current_user_id, $current_user);

            return true;
        } else {
            $form['error'] = 'Neturi pakankamai tasku, kad isigytum ar pakeistum pixeli!';

            return false;
        }
    }
}