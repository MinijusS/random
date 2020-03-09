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
                'validate_not_empty',
                'validate_spaces',
                'validate_text_length' => [
                    'min' => 0,
                    'max' => 30
                ]
            ]
        ],
        'email' => [
            'label' => 'E-mail',
            'type' => 'email',
            'placeholder' => 'vardenis@gmail.com',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'phone' => [
            'label' => 'Phone',
            'type' => 'text',
            'placeholder' => '+3706000000',
            'validate' => [
                'validate_not_empty',
                'validate_phone'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'placeholder' => '********',
            'validate' => [
                'validate_not_empty',
                'validate_text_length' => [
                    'min' => 0,
                    'max' => 6
                ]
            ]
        ],
        'password_repeat' => [
            'label' => 'Repeat password',
            'type' => 'password',
            'placeholder' => '********',
            'validate' => [
                'validate_not_empty',
                'validate_text_length' => [
                    'min' => 0,
                    'max' => 6
                ]
            ]
        ],
//        'number1' => [
//            'label' => 'Number X',
//            'type' => 'number',
//            'placeholder' => '30',
//            'filter' => FILTER_SANITIZE_NUMBER_INT,
//            'validate' => [
//                'validate_not_empty',
//                'validate_is_number'
//            ]
//        ],
//        'number2' => [
//            'label' => 'Number Y',
//            'type' => 'number',
//            'placeholder' => '50',
//            'filter' => FILTER_SANITIZE_NUMBER_INT,
//            'validate' => [
//                'validate_not_empty',
//                'validate_is_number'
//            ]
//        ],
//        'textarea' => [
//            'label' => 'Comment',
//            'type' => 'textarea',
//            'placeholder' => 'Cia yra tavo tekstas...',
//            'validate' => [
//                'validate_not_empty'
//            ]
//        ],
//        'select' => [
//            'type' => 'select',
//            'label' => 'Veiksmas',
//            'options' => [
//                'Sudetis' => 'Sudetis',
//                'Atimtis' => 'Atimtis',
//                'Dalyba' => 'Dalyba',
//                'Daugyba' => 'Daugyba'
//            ],
//            'validate' => [
//                'validate_select'
//            ]
//        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Submit',
            'value' => 'submit',
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
function form_success($safe_input)
{
//    $action = $safe_input['select'];
//    switch ($safe_input['select']) {
//        case $action == 'Sudetis':
//            print $safe_input['number1'] + $safe_input['number2'];
//            break;
//        case $action == 'Atimtis':
//            print $safe_input['number1'] - $safe_input['number2'];
//            break;
//        case $action == 'Dalyba':
//            print $safe_input['number1'] / $safe_input['number2'];
//            break;
//        case $action == 'Daugyba':
//            print $safe_input['number1'] * $safe_input['number2'];
//            break;
//    }
}

/**
 * F-cija, kuri ivyks, kai forma neatitiks nors vieno reikalavimo
 */
function form_fail()
{

}

?>
<html>
<head>
    <title>Formos</title>
    <link href="/app/assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include 'core/templates/form.tpl.php'; ?>
</body>
</html>