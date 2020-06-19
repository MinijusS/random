<?php

use App\Cart\Item;
use App\Cart\Orders\Order;
use Core\Views\Form;
use Core\Views\Table;
use App\Users\User;

include '../bootloader.php';

function delete_success($safe_input, $form)
{
    \App\Cart\Model::deleteById($safe_input['id']);
    header("Location: /cart.php");
}

function form_success($safe_input, $form)
{
    $items = \App\Cart\Model::getWhere(['user_id' => App\App::$session->getUser()->getId(),
        'status' => Item::STATUS_IN_CART]);

    $order = new Order(['date' => strtotime("now")]);
    $order_id = \App\Cart\Orders\Model::insert($order);
    $order->setId($order_id);
    $order->setUserId(App\App::$session->getUser()->getId());
    $order->setStatus(Order::STATUS_SUBMITTED);

    $sum = 0;

    foreach ($items as $item) {
        $item->setStatus(Item::STATUS_ORDERED);
        $item->setOrderId($order_id);
        \App\Cart\Model::update($item);

        $sum += ($item->drink()->price);
    }
    $order->setPrice($sum);
    \App\Cart\Orders\Model::update($order);
    header("Location: /");
}

$user = \App\App::$session->getUser();

$catalog_table = [
    'thead' => [
        'Nr.',
        'Prekes Pavadinimas',
        'Kaina',
        'Veiksmai',
    ],
    'tbody' => []
];

$cancel_form = [
    'attr' => [
        'method' => 'POST',
        'class' => 'mini-form',
        'id' => 'admin_form'
    ],
    'fields' => [
        'id' => [
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

$order_form = [
    'attr' => [
        'method' => 'POST',
        'class' => 'mini-form',
        'id' => 'admin_form'
    ],
    'buttons' => [
        'order' => [
            'title' => 'Uzsakyti',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]
        ]
    ],
    'validators' => [],
    'callbacks' => [
        'success' => 'form_success',
    ]
];
$number = 1;

$matched_items = \App\Cart\Model::getWhere(['user_id' => $user->getId(), 'status' => Item::STATUS_IN_CART]);

foreach ($matched_items as $match_id => $matched_item) {
    $cancel_form['fields']['id']['value'] = $matched_item->id;
    $cancelForm = new Form($cancel_form);

    $catalog_table['tbody'][] = [
        $number,
        $matched_item->drink()->name,
        $matched_item->drink()->price,
        $cancelForm->render()
    ];
    $number++;
}

$catalog = new Table($catalog_table);

if ($_POST && \App\App::$session->userIs(User::ROLE_USER)) {
    $pressed_btn = get_form_action($_POST);
    if ($pressed_btn == 'delete') {
        $sanitized_items = get_filtered_input($cancel_form);
        validate_form($cancel_form, $sanitized_items);
    } else if ($pressed_btn == 'order') {
        $sanitized_items = get_filtered_input($order_form);
        validate_form($order_form, $sanitized_items);
    }
}
$order_btn = new Form($order_form);
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include ROOT . '/app/templates/nav.tpl.php'; ?>
<?php print $catalog->render(); ?>
<?php print $order_btn->render(); ?>
</body>
</html>