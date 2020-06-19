<?php
include '../../bootloader.php';

use App\Drinks\Drink;
use Core\View;

/**
 * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
 */
function form_success($safe_input, &$form)
{
    \App\Drinks\Model::insert(new Drink($safe_input));
    header("Location: /admin/view.php");
}

$currentUser = \App\App::$session->getUser();

$form = [
    'attr' => [
        'action' => '/admin/create.php',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'admin_form'
    ],
    'fields' => [
        'name' => [
            'label' => 'Pavadinimas',
            'type' => 'text',
            'placeholder' => 'Lituanica',
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'degrees' => [
            'label' => 'Laipsniai',
            'type' => 'number',
            'placeholder' => 'pvz: 40',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'capacity' => [
            'label' => 'Turis',
            'type' => 'number',
            'placeholder' => 'pvz: 500',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'storage' => [
            'label' => 'Kiekis sandelyje',
            'type' => 'number',
            'placeholder' => 'pvz: 10',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'price' => [
            'label' => 'Kaina',
            'type' => 'number',
            'placeholder' => 'pvz: 10',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'photo' => [
            'label' => 'Nuotrauka',
            'type' => 'text',
            'placeholder' => 'pvz: https://...',
            'validate' => [
                'validate_not_empty'
            ]
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Prideti',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'submit'
                ]
            ]
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

$form = new View($form);

?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="../assets/styles.css" rel="stylesheet">
</head>
<body>
<?php if (!isset($_SESSION['email'])): ?>
    <?php header("Location: /"); ?>
<?php else: ?>
    <?php include ROOT . '/app/templates/nav.tpl.php'; ?>
    <?php print $form->render(ROOT . '/core/templates/form.tpl.php'); ?>
<?php endif; ?>
</body>
</html>