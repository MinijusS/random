<?php
include '../bootloader.php';

$current_user = App\App::$session->getUser();
$pixels = App\App::$db->getRowsWhere('pixels');
$users = App\App::$db->getRowsWhere('users');

$point_price = 5;

function form_success($safe_input, &$form)
{
    $condition = [
        'x' => $safe_input['x'],
        'y' => $safe_input['y']
    ];

    $row = [
        'x' => $safe_input['x'],
        'y' => $safe_input['y'],
        'color' => $safe_input['color'],
        'user' => $_SESSION['email']
    ];

    if ($existing_pixel = App\App::$db->getRowWhere('pixels', $condition)) {
        $existing_pixel_id = array_key_first($existing_pixel);
        App\App::$db->updateRow('pixels', $existing_pixel_id, $row);
    } else {
        App\App::$db->insertRow('pixels', $row);
    }

    header("Location: /");
}

$form = [
    'attr' => [
        'action' => '/',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'buy_pixel'
    ],
    'fields' => [
        'x' => [
            'label' => 'X Reiksme',
            'type' => 'number',
            'placeholder' => '200',
            'validate' => [
                'validate_not_empty',
                'validate_is_number',
                'validate_number_range' => [
                    'min' => 0,
                    'max' => 500,
                ]
            ]
        ],
        'y' => [
            'label' => 'Y Reiksme',
            'type' => 'number',
            'placeholder' => '300',
            'validate' => [
                'validate_not_empty',
                'validate_is_number',
                'validate_number_range' => [
                    'min' => 0,
                    'max' => 500,
                ]
            ]
        ],
        'color' => [
            'label' => 'Pixelio spalva',
            'type' => 'color',
            'validate' => [

            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Pirkti pixeli',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'buy'
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_pixel',
        'validate_points' => [
            'points' => $point_price
        ]
    ],
    'callbacks' => [
        'success' => 'form_success',
    ]
];

$table = [
    'thead' => [
        'Username',
        'Email',
        'Points'
    ],
    'tbody' => []
];

foreach ($users as $user) {
    unset($user['password']);
    unset($user['admin']);
    $table['tbody'][] = $user;
}

$h1 = "Jus esate neprisijunges!";

if ($_POST && $current_user) {
    $sanitized_items = get_filtered_input($form);
    validate_form($form, $sanitized_items);
}
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include '../app/templates/nav.tpl.php'; ?>
<section class="first-section">
    <div class="pixels-box">
        <?php foreach ($pixels ?? [] as $pixel): ?>
            <div class="pixel tooltip"
                 style="left: <?php print $pixel['x']; ?>;top: <?php print $pixel['y']; ?>; background-color: <?php print $pixel['color']; ?>;">
                <span class="tooltiptext"><?php print $pixel['user']; ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if ($current_user): ?>
        <section class="right-panel">
            <h2>Tavo turimi taskai: <span class="error"><?php print $current_user['points']; ?></span></h2>
            <span>(1 pixel costs <?php print $point_price; ?> points)</span>
            <?php if ($current_user['points'] <= $point_price): ?>
                <a class="btn btn-primary buy" href="/buypoints.php">Nusipirkti dar tasku</a>
            <?php endif; ?>
            <section>
                <?php include '../core/templates/form.tpl.php'; ?>
            </section>
        </section>
        <?php if ($current_user && $current_user['admin']): ?>
            <section class="admin">
                <h2>Admin Panel</h2>
                <?php include ROOT . '/core/templates/table.tpl.php'; ?>
            </section>
        <?php endif; ?>
    <?php else: ?>
        <section>
            <h1><?php print $h1; ?></h1>
        </section>
    <?php endif; ?>
</section>
<footer>

</footer>
</body>
</html>