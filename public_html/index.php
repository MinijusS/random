<?php

use App\Cart\Item;
use App\Pixels\Pixel;
use Core\Views\Catalog;
use Core\Views\Form;
use Core\Views\Table;
use App\Users\User;
use Core\View;

include '../bootloader.php';
function add_success($safe_input, $form)
{
    $safe_input['user_id'] = \App\App::$session->getUser()->getId();
    $safe_input['status'] = Item::STATUS_IN_CART;
    \App\Cart\Model::insert(new Item($safe_input));
}

$user = \App\App::$session->getUser();
$drinks = \App\Drinks\Model::getWhere([]);

$add_form = [
    'callbacks' => [
        'success' => 'add_success',
    ],
    'fields' => [
        'drink_id' => [
            'type' => 'hidden'
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Add to cart',
        ],
    ],
];

$catalog_data = [];
foreach ($drinks as $drink_id => $drink) {
    $catalog_item = ['drink' => $drink];
    if ($user) {
        $add_form['fields']['drink_id']['value'] = $drink->id;
        $catalog_item['form'] = new Form($add_form);
    }
    $catalog_data[] = $catalog_item;
}

if ($_POST && \App\App::$session->userIs(User::ROLE_USER)) {
    $sanitized_items = get_filtered_input($add_form);
    validate_form($add_form, $sanitized_items);
}

$catalog = new Catalog($catalog_data);



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