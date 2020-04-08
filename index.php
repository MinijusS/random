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
//        'phone' => [
//            'label' => 'Phone',
//            'type' => 'text',
//            'placeholder' => '+3706000000',
//            'validate' => [
//                'validate_not_empty',
//                'validate_phone'
//            ]
//        ],
//        'password' => [
//            'label' => 'Password',
//            'type' => 'password',
//            'placeholder' => '********',
//            'validate' => [
//                'validate_not_empty',
//                'validate_text_length' => [
//                    'min' => 6,
//                    'max' => 20
//                ]
//            ]
//        ],
//        'password_repeat' => [
//            'label' => 'Repeat password',
//            'type' => 'password',
//            'placeholder' => '********',
//            'validate' => [
//                'validate_not_empty',
//                'validate_text_length' => [
//                    'min' => 6,
//                    'max' => 20
//                ]
//            ]
//        ],
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
        'question1' => [
            'type' => 'radio',
            'label' => 'Ar laikai kardana?',
            'options' => [
                'yes' => 'Taip',
                'no' => 'Ne',
            ],
            'validate' => [
                'validate_select',
            ]
        ],
        'question2' => [
            'type' => 'radio',
            'label' => 'Ar pili i baka?',
            'options' => [
                'yes' => 'Taip',
                'no' => 'Ne',
            ],
            'validate' => [
                'validate_select',
            ]
        ],
        'question3' => [
            'type' => 'radio',
            'label' => 'Ar rukai zoliu arbata?',
            'options' => [
                'yes' => 'Taip',
                'no' => 'Ne',
            ],
            'validate' => [
                'validate_select',
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Ziureti statistika',
            'value' => 'submit',
        ]
    ],
    'validators' => [
//        'validate_fields_match' => [
//            'password',
//            'password_repeat'
//        ]
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
function form_success($safe_input, $form)
{
    $existing = file_to_array(DB_FILE);
    $existing[] = $safe_input;
    array_to_file($existing, DB_FILE);
    setcookie('form_done', 1, strtotime('+1 year'));
    $_COOKIE['form_done'] = true;
}

/**
 * F-cija, kuri ivyks, kai forma neatitiks nors vieno reikalavimo
 */
function form_fail($safe_input, $form)
{
    setcookie('data', json_encode($safe_input), time() + 3600);
}

if (isset($_COOKIE['data'])) {
    $decoded_data = json_decode($_COOKIE['data'], true);
    foreach ($decoded_data as $data_index => $data_item) {
        foreach ($form['fields'] as $field_index => &$field) {
            if ($data_index == $field_index) {
                $field['value'] = urldecode($data_item);
                unset($field);
            }
        }
    }
}

$user_id = $_COOKIE['user_id'] ?? microtime();
$visits = ($_COOKIE['visits'] ?? 0) + 1;

setcookie('user_id', $user_id, strtotime('+1 year'));
setcookie('visits', $visits, strtotime('+1 year'));

!isset($_COOKIE['form_done']) ?: header('Location: results.php');

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