<?php
include '../bootloader.php';

/**
 * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
 */
function form_success($safe_input, &$form)
{
    unset($safe_input['password_repeat']);
    $hashed_password = crypt($safe_input['password'], HASH_SALT);
    $safe_input['password'] = $hashed_password;

    App\App::$db->insertRow('users', $safe_input);

    $form['success'] = 'Vartotojas sekmingai pridetas!';
    $page = $_SERVER['PHP_SELF'];
    header("Refresh: 2; url=$page");
}

$form = [
    'attr' => [
        'action' => '/register.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'register_form'
    ],
    'fields' => [
        'username' => [
            'label' => 'Tavo slapyvardis',
            'type' => 'text',
            'placeholder' => 'Vardenis',
            'validate' => [
                'validate_not_empty',
                'validate_text_length' => [
                    'min' => 4,
                    'max' => 10
                ]
            ]
        ],
        'email' => [
            'label' => 'Tavo el.pastas',
            'type' => 'email',
            'placeholder' => 'vardenis@email.com',
            'validate' => [
                'validate_not_empty',
                'validate_email',
                'validate_email_unique'
            ]
        ],
        'password' => [
            'label' => 'Slaptazodis',
            'type' => 'password',
            'placeholder' => '**********',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'password_repeat' => [
            'label' => 'Slaptazodis',
            'type' => 'password',
            'placeholder' => '**********',
            'validate' => [
                'validate_not_empty'
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Registruotis',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'register'
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ],
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
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include '../app/templates/nav.tpl.php'; ?>
<?php include '../core/templates/form.tpl.php'; ?>
</body>
</html>