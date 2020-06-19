<?php

use Core\Views\Link;
use Core\Views\Table;

include '../../bootloader.php';

$user = \App\App::$session->getUser();

$catalog_table = [
    'thead' => [
        'Nr.',
        'Preke',
        'Kaina'
    ],
    'tbody' => []
];

$number = 1;

$matched_items = \App\Cart\Model::getWhere(['user_id' => \App\App::$session->getUser()->getId(),
    'order_id' => $_GET['id']]);
foreach ($matched_items as $matched_item) {
    $catalog_table['tbody'][] = [
        $number,
        $matched_item->drink()->getName(),
        $matched_item->drink()->getPrice()
    ];
    $number++;
}

$order = \App\Cart\Orders\Model::get($_GET['id']);

$order_name = 'Uzsakymo ID: ' . $_GET['id'];

$order_price = 'Viso kaina: ' . $order->getPrice();

$catalog = new Table($catalog_table);
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="../assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include ROOT . '/app/templates/nav.tpl.php'; ?>
<h1><?php print $order_name; ?></h1>
<?php print $catalog->render(); ?>
<h1><?php print $order_price; ?></h1>
</body>
</html>