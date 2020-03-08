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

//SUBMIT MYGTUKO PASPAUDIMU
if ($_POST && $_POST['action'] == 'submit') {
    $sanitized_items = get_filtered_input($form);
    validate_form($form, $sanitized_items);
    foreach ($form['fields'] as $field) {
        if (isset($field['errors'])) {
            print 'Yra erroru';
            break;
        }
    }
}
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