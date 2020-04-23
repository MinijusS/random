<?php
//include 'bootloader.php';
//
///**
// * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
// */
//function form_success($safe_input, &$form)
//{
//    $existing = file_to_array(TEAMS_FILE);
//    $team_id = $safe_input['team'];
//    if (isset($existing[$team_id]['players'])) {
//        foreach ($existing[$team_id]['players'] ?? [] as $player) {
//            if ($player['name'] == $safe_input['username']) {
//                if (crypt($safe_input['password'], $player['password']) == $player['password']) {
//                    // password is correct
//                    $form['success'] = 'Sekmingai prisijungete!';
//                    setcookie('user', json_encode($safe_input), time() + 3600, '/');
//                    $page = $_SERVER['PHP_SELF'];
//                    header("Refresh: 2; url=$page");
//                } else {
//                    $form['error'] = 'Slaptazodis neteisingas!';
//                    foreach ($form['fields'] as $field_id => &$field) {
//                        if ($field_id != 'password') {
//                            $field['value'] = $safe_input[$field_id];
//                        }
//                    }
//                }
//            } else {
//                create_user($safe_input, $form);
//
//            }
//        }
//    } else {
//        create_user($safe_input, $form);
//    }
//}
//
//$form = [
//    'attr' => [
//        'action' => '/join.php',
//        'method' => 'POST',
//        'class' => 'my-form',
//        'id' => 'join_form'
//    ],
//    'fields' => [
//        'team' => [
//            'label' => 'Komandos pavadinimas',
//            'type' => 'select',
//            'placeholder' => 'Pasirinkite komanda',
//            'validate' => [
//                'validate_selected'
//            ]
//        ]
//    ],
//    'buttons' => [
//        'submit' => [
//            'title' => 'Prisijungti prie komandos',
//            'value' => 'submit',
//            'extras' => [
//                'attr' => [
//                    'class' => 'join_btn'
//                ]
//            ]
//        ]
//    ],
//    'validators' => [
//
//    ],
//    'callbacks' => [
//        'success' => 'form_success',
//    ]
//];
//
//$existing = file_to_array(TEAMS_FILE);
//
////Tikriname userio slapuka, jeigu jis yra spausdiname teksta
//if (isset($_COOKIE['user'])) {
//    $decoded_data = json_decode($_COOKIE['user'], true);
//    $team = $existing[$decoded_data['team']]['team_id'];
//    $h1 = "Zdarova pzdaballs zaidejau - \"{$decoded_data['username']}\". Jau esi komandoje - \"{$team}\"";
//} else {
//    if ($_POST) {
//        $sanitized_items = get_filtered_input($form);
//        validate_form($form, $sanitized_items);
//    }
//
//    foreach ($existing ?? [] as $item) {
//        $form['fields']['team']['options'][] = $item['team_id'];
//    }
//}
//?>
<!--<html>-->
<!--<head>-->
<!--    <title>PZDABALL KOMANDA</title>-->
<!--    <link href="/app/assets/styles.css" rel="stylesheet">-->
<!--</head>-->
<!--<body>-->
<?php //include 'app/templates/nav.tpl.php'; ?>
<?php //if (isset($_COOKIE['user'])): ?>
<!--    --><?php //print header("Location: play.php"); ?>
<?php //else: ?>
<!--    <h1>Prisijungti prie komandos</h1>-->
<!--    --><?php //include 'core/templates/form.tpl.php'; ?>
<?php //endif; ?>
<!--</body>-->
<!--</html>-->