<?php

use Core\Views\Link;
use Core\Views\Table;

include '../../../bootloader.php';

$user = \App\App::$session->getUser();

$catalog_table = [
    'thead' => [
        'Nr.',
        'Statusas',
        'Vardas',
        'Email',
        'Kaina',
        'Data',
        'Veiksmai',
    ],
    'tbody' => []
];

$number = 1;

$matched_items = \App\Cart\Orders\Model::getWhere([]);
foreach ($matched_items as $matched_item) {
    $view = new Link([
        'url' => "/admin/orders/view.php?id={$matched_item->getId()}",
        'title' => 'Perziureti',
        'attr' => [
            'class' => 'btn btn-edit'
        ]]);
    $catalog_table['tbody'][] = [
        $number,
        $matched_item->_getStatusName(),
        $matched_item->user()->getUsername(),
        $matched_item->user()->getEmail(),
        $matched_item->getPrice(),
        gmdate("Y-m-d H:i", $matched_item->getDate()),
        $view->render()
    ];
    $number++;
}

$catalog = new Table($catalog_table);
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="../../assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include ROOT . '/app/templates/nav.tpl.php'; ?>
<?php print $catalog->render(); ?>
</body>
</html>