<?php
include 'bootloader.php';

/**
 * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
 */
function form_success($safe_input, &$form)
{
    $existing = file_to_array(TEAMS_FILE);
    $existing[] = $safe_input;
    array_to_file($existing, TEAMS_FILE);
    $form['success'] = 'Komanda sekmingai sukurta!';
}

$form = [
    'attr' => [
        'action' => '/create.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'form-id'
    ],
    'fields' => [
        'team_id' => [
            'label' => 'Komandos pavadinimas',
            'type' => 'text',
            'placeholder' => 'Barsukai',
            'validate' => [
                'validate_not_empty',
                'validate_text_length' => [
                    'min' => 3,
                    'max' => 30
                ],
                'validate_team'
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Sukurti komanda',
            'value' => 'submit',
        ]
    ],
    'validators' => [],
    'callbacks' => [
        'success' => 'form_success',
    ]
];

if ($_POST) {
    $sanitized_items = get_filtered_input($form);
    validate_form($form, $sanitized_items);
}
?>
<html>
<head>
    <title>PZDABALL KOMANDA</title>
    <link href="/app/assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'app/templates/nav.tpl.php'; ?>
<h1>Sukurti komanda</h1>
<?php include 'core/templates/form.tpl.php'; ?>
</body>
</html>