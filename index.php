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
            'type' => 'text'
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'filter' => FILTER_SANITIZE_NUMBER_INT
        ],
        'textarea' => [
            'label' => 'Komentaras',
            'type' => 'textarea'
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'SUBMIT',
            'value' => 'submit',
        ],
        'update' => [
            'title' => 'UPDATE',
            'value' => 'update'
        ]
    ]
];

//Funkcija tikrinanti mygtuko paspaudima
pressed_button($form);
?>
<html>
<head>
    <title>Formos</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<?php include 'templates/form.tpl.php'; ?>
</body>
</html>