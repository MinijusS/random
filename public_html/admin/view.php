<?php

use Core\Views\Form;
use Core\Views\Link;
use Core\Views\Table;

include '../../bootloader.php';

function delete_success($safe_input, $form)
{
    \App\Drinks\Model::deleteById($safe_input['id']);
    header("Location: /admin/view.php");
}

$current_user = App\App::$session->getUser();
$drinks = \App\Drinks\Model::getWhere();

$catalog_table = [
    'thead' => [
        'ID',
        'Pavadinimas',
        'Laipsniai',
        'Turis',
        'Kiekis Sandelyje',
        'Kaina',
        'Nuotrauka',
        'Veiksmai'
    ],
    'tbody' => []
];

$delete_form = [
    'attr' => [
        'method' => 'POST',
        'class' => 'mini-form',
        'id' => 'admin_form'
    ],
    'fields' => [
        'id' => [
            'label' => '',
            'type' => 'hidden'
        ],
    ],
    'buttons' => [
        'delete' => [
            'title' => 'Trinti',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'btn btn-delete'
                ]
            ]
        ]
    ],
    'validators' => [],
    'callbacks' => [
        'success' => 'delete_success',
    ]
];

foreach ($drinks as $row_id => $drink) {
    $edit = new Link([
        'url' => "/admin/edit.php?id={$drink->getId()}",
        'title' => 'Redaguoti',
        'attr' => [
            'class' => 'btn btn-edit'
        ]]);

    $delete_form['fields']['id']['value'] = $drink->getId();
    $delete_view = new Form($delete_form);

    $row = $drink->_getData();
    $row['edit'] = $edit->render();
    $row['delete'] = $delete_view->render();

    $catalog_table['tbody'][] = $row;
}

$catalogTable = new Table($catalog_table);

if ($_POST && $current_user) {
    $sanitized_items = get_filtered_input($delete_form);
    validate_form($delete_form, $sanitized_items);
}
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="../assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include ROOT . '/app/templates/nav.tpl.php'; ?>

<div>
    <?php print $catalogTable->render(); ?>
</div>
</body>
</html>