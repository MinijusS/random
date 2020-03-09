<?php
include 'bootloader.php';

$form = [
    'attr' => [
        'action' => '/',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'form-id'
    ],
    'fields' => [
        'name' => [
            'label' => 'Username',
            'type' => 'text',
            'placeholder' => 'Vardenis Pavardenis',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'placeholder' => '********',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'age' => [
            'label' => 'Age',
            'type' => 'number',
            'placeholder' => '30',
            'filter' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => [
                'validate_not_empty',
                'validate_is_number',
                'validate_is_positive',
                'validate_max_100'
            ]
        ],
        'textarea' => [
            'label' => 'Comment',
            'type' => 'textarea',
            'placeholder' => 'Cia yra tavo tekstas...',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'select' => [
            'type' => 'select',
            'label' => 'Level',
            'options' => [
                'Beginner',
                'Intermediate',
                'Professional'
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'SUBMIT',
            'value' => 'submit',
        ]
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ]
];

if ($_POST) {
    $sanitized_items = get_filtered_input($form);
    validate_form($form, $sanitized_items);
}

/**
 * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
 */
function form_success()
{
    var_dump('Blet zjbs');
}

/**
 * F-cija, kuri ivyks, kai forma neatitiks nors vieno reikalavimo
 */
function form_fail()
{
    var_dump('Blet nezjbs');
}
?>
<html>
<head>
    <title>Formos</title>
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'templates/form.tpl.php'; ?>
</body>
</html>