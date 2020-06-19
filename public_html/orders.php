<?php

use App\Cart\Item;
use App\Cart\Orders\Order;
use Core\Views\Form;
use Core\Views\Link;
use Core\Views\Table;
use App\Users\User;

include '../bootloader.php';

$user = \App\App::$session->getUser();

$catalog_table = [
    'thead' => [
        'Order ID.',
        'Data',
        'Kaina',
        'Veiksmai',
    ],
    'tbody' => []
];

$number = 0;

$matched_items = \App\Cart\Orders\Model::getWhere(['user_id' => \App\App::$session->getUser()->getId()]);
foreach ($matched_items as $matched_item) {
    $view = new Link([
        'url' => "/orders/view.php?id={$matched_item->getId()}",
        'title' => 'Perziureti',
        'attr' => [
            'class' => 'btn btn-edit'
        ]]);
    $catalog_table['tbody'][] = [
        $number,
        gmdate("Y-m-d", $matched_item->getDate()),
        $matched_item->getPrice(),
        $view->render()
    ];
    $number++;
}

$catalog = new Table($catalog_table);

//if ($_POST && \App\App::$session->userIs(User::ROLE_USER)) {
//    $sanitized_items = get_filtered_input($cancel_form);
//    validate_form($cancel_form, $sanitized_items);
//}
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include ROOT . '/app/templates/nav.tpl.php'; ?>
<?php print $catalog->render(); ?>
</body>
</html>