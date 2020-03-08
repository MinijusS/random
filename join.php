<?php
include 'bootloader.php';

/**
 * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
 */
function form_success($safe_input, &$form)
{
    $existing = file_to_array(TEAMS_FILE);
    $team_id = $safe_input['team'];
    $existing[$team_id]['players'][] = ['name' => $safe_input['username'], 'score' => 0];
    array_to_file($existing, TEAMS_FILE);
    $form['success'] = 'Sekmingai prisijungete i komanda!';
    setcookie('user', json_encode($safe_input), time() + 3600, '/');
}

$form = [
    'attr' => [
        'action' => '/join.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'join_form'
    ],
    'fields' => [
        'team' => [
            'label' => 'Komandos pavadinimas',
            'type' => 'select',
            'placeholder' => 'Pasirinkite komanda',
            'validate' => [
                'validate_selected'
            ]
        ],
        'username' => [
            'label' => 'Tavo slapyvardis',
            'type' => 'text',
            'placeholder' => 'Bibiagalvis',
            'validate' => [
                'validate_not_empty',
                'validate_text_length' => [
                    'min' => 4,
                    'max' => 10
                ]
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Prisijungti',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'join_btn'
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_player_unique'
    ],
    'callbacks' => [
        'success' => 'form_success',
    ]
];

$existing = file_to_array(TEAMS_FILE);

//Tikriname userio slapuka, jeigu jis yra spausdiname teksta
if (isset($_COOKIE['user'])) {
    $decoded_data = json_decode($_COOKIE['user'], true);
    $team = $existing[$decoded_data['team']]['team_id'];
    $h1 = "Zdarova pzdaballs zaidejau - \"{$decoded_data['username']}\". Jau esi komandoje - \"{$team}\"";
} else {
    if ($_POST) {
        $sanitized_items = get_filtered_input($form);
        validate_form($form, $sanitized_items);
    }

    foreach ($existing ?? [] as $item) {
        $form['fields']['team']['options'][] = $item['team_id'];
    }
}
?>
<html>
<head>
    <title>PZDABALL KOMANDA</title>
    <link href="/app/assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'app/templates/nav.tpl.php'; ?>
<?php if (isset($_COOKIE['user'])): ?>
    <h1><?php print $h1; ?></h1>
<?php else: ?>
    <h1>Prisijungti prie komandos</h1>
    <?php include 'core/templates/form.tpl.php'; ?>
<?php endif; ?>
</body>
</html>