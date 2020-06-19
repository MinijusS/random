<?php

use App\Users\User;
use Core\Views\Link;
use Core\Views\Table;

include '../../../bootloader.php';

$change_status_form = [
    'callbacks' => [
        'success' => 'form_success',
    ],
    'fields' => [
        'select' => [
            'type' => 'select',
            'label' => 'Bukle',
            'placeholder' => 'Pasirinkti',
            'options' => [
                \App\Cart\Orders\Order::STATUS_SUBMITTED => 'Submitted',
                \App\Cart\Orders\Order::STATUS_SHIPPED => 'Shipped',
                \App\Cart\Orders\Order::STATUS_DELIVERED => 'Delivered',
                \App\Cart\Orders\Order::STATUS_CANCELED => 'Canceled'
            ]
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Issaugoti'
        ],
    ],
];

function form_success($safe_input, $form)
{
    $order = \App\Cart\Orders\Model::get($_GET['id']);
    $order->setStatus($safe_input['select']);
    \App\Cart\Orders\Model::update($order);
    header("Location: /admin/orders/index.php");
}

$user = \App\App::$session->getUser();

$order = \App\Cart\Orders\Model::get($_GET['id']);

$order_name = 'Uzsakymo ID: ' . $order->getId();

$order_price = 'Viso kaina: ' . $order->getPrice();

$catalog_table = [
    'thead' => [
        'Nr.',
        'Preke',
        'Kaina'
    ],
    'tbody' => []
];

$number = 1;

$matched_items = \App\Cart\Model::getWhere(['user_id' => $order->getUserId(),
    'order_id' => $_GET['id']]);
foreach ($matched_items as $matched_item) {
    $catalog_table['tbody'][] = [
        $number,
        $matched_item->drink()->getName(),
        $matched_item->drink()->getPrice()
    ];
    $number++;
}

$catalog = new Table($catalog_table);
$form = new \Core\Views\Form($change_status_form);

if ($_POST && \App\App::$session->userIs(User::ROLE_USER)) {
    $sanitized_items = get_filtered_input($change_status_form);
    validate_form($change_status_form, $sanitized_items);
}
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="../../assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include ROOT . '/app/templates/nav.tpl.php'; ?>
<h1><?php print $order_name; ?></h1>
<h3>Vardas: <?php print \App\Users\Model::get($order->getUserId())->getUsername() ?></h3>
<h3>Email: <?php print \App\Users\Model::get($order->getUserId())->getEmail() ?></h3>
<h3>Statusas: <?php print $order->_getStatusName(); ?></h3>
<?php print $catalog->render(); ?>
<h3><?php print $order_price; ?></h3>
<?php print $form->render(); ?>
</body>
</html>