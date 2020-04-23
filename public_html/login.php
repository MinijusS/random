<?php
include '../bootloader.php';

/**
 * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
 */
function form_success($safe_input, &$form)
{
    $page = $_SERVER['PHP_SELF'];
    header("Refresh: 5; url=$page");
    $_SESSION['email'] = $safe_input['email'];
    $_SESSION['password'] = $safe_input['password'];
}

$form = [
    'attr' => [
        'action' => '/login.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'login_form'
    ],
    'fields' => [
        'email' => [
            'label' => 'Tavo el.pastas',
            'type' => 'email',
            'placeholder' => 'vardenis@email.com',
            'validate' => [
                'validate_not_empty',
                'validate_email',
            ]
        ],
        'password' => [
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
            'title' => 'Prisijungti',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'login'
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_login'
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
<?php if (isset($_SESSION['email'])): ?>
    <?php header("Location: /"); ?>
<?php else: ?>
    <?php include '../app/templates/nav.tpl.php'; ?>
    <?php include '../core/templates/form.tpl.php'; ?>
<?php endif; ?>
</body>
</html>