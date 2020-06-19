<?php
include '../../bootloader.php';

use App\Drinks\Drink;
use Core\View;

/**
 * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
 */
function form_success($safe_input, &$form)
{
    $drink = new Drink($safe_input);
    \App\Drinks\Model::update($drink);
    header("Location: /admin/view.php");
}

$id = $_GET['id'] ?? null;
if ($id !== null) {
    if (strlen($id) > 0) {
        $drink = \App\Drinks\Model::get((int)$id);
    }
    if (!($drink ?? null)) {
        header('Location: /admin/view.php');
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $drink = \App\Drinks\Model::get($id);
}

if(!$drink) {
    header("Location: /admin/view.php");
}

$form = [
    'attr' => [
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'admin_form'
    ],
    'fields' => [
        'id' => [
            'type' => 'hidden',
            'label' => '',
            'value' => $drink->getId(),
        ],
        'name' => [
            'label' => 'Pavadinimas',
            'type' => 'text',
            'placeholder' => 'Lituanica',
            'value' => $drink->name,
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'degrees' => [
            'label' => 'Laipsniai',
            'type' => 'number',
            'placeholder' => 'pvz: 40',
            'value' => $drink->degrees,
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'capacity' => [
            'label' => 'Turis',
            'type' => 'number',
            'placeholder' => 'pvz: 500',
            'value' => $drink->capacity,
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'storage' => [
            'label' => 'Kiekis sandelyje',
            'type' => 'number',
            'placeholder' => 'pvz: 10',
            'value' => $drink->storage,
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'price' => [
            'label' => 'Kaina',
            'type' => 'number',
            'placeholder' => 'pvz: 10',
            'value' => $drink->price,
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'photo' => [
            'label' => 'Nuotrauka',
            'type' => 'text',
            'placeholder' => 'pvz: https://...',
            'value' => $drink->photo,
            'validate' => [
                'validate_not_empty'
            ]
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Atnaujinti',
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